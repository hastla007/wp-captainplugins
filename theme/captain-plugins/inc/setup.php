<?php
/** One-time setup wizard shown after Captain Plugins is activated. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const CAPTAIN_PLUGINS_SETUP_PAGE = 'captain-plugins-setup';

function captain_plugins_setup_url( array $args = array() ): string {
	return add_query_arg( array_merge( array( 'page' => CAPTAIN_PLUGINS_SETUP_PAGE ), $args ), admin_url( 'themes.php' ) );
}

add_action(
	'after_switch_theme',
	static function (): void {
		if ( ( defined( 'WP_CLI' ) && WP_CLI ) || ! is_admin() || ! current_user_can( 'switch_themes' ) ) {
			return;
		}
		set_transient( 'captain_plugins_setup_redirect', get_current_user_id(), 10 * MINUTE_IN_SECONDS );
	}
);

add_action(
	'admin_init',
	static function (): void {
		$user_id = absint( get_transient( 'captain_plugins_setup_redirect' ) );
		if ( ! $user_id || get_current_user_id() !== $user_id || wp_doing_ajax() || wp_doing_cron() || is_network_admin() || ! current_user_can( 'manage_options' ) || 'GET' !== ( $_SERVER['REQUEST_METHOD'] ?? 'GET' ) ) {
			return;
		}
		// Read-only comparison of the current admin page; no state is changed from request data.
		if ( CAPTAIN_PLUGINS_SETUP_PAGE === sanitize_key( (string) wp_unslash( $_GET['page'] ?? '' ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			delete_transient( 'captain_plugins_setup_redirect' );
			return;
		}
		delete_transient( 'captain_plugins_setup_redirect' );
		wp_safe_redirect( captain_plugins_setup_url() );
		exit;
	}
);

add_action(
	'admin_menu',
	static function (): void {
		add_theme_page( __( 'Captain Plugins einrichten', 'captain-plugins' ), __( 'Einrichtung', 'captain-plugins' ), 'manage_options', CAPTAIN_PLUGINS_SETUP_PAGE, 'captain_plugins_setup_page' );
	}
);

function captain_plugins_setup_plugin_source(): string {
	$source = defined( 'CAPTAIN_LICENSE_PLUGIN_ZIP' ) ? trim( (string) CAPTAIN_LICENSE_PLUGIN_ZIP ) : '';
	if ( '' === $source ) {
		return '';
	}
	if ( preg_match( '#^https://#i', $source ) ) {
		return $source;
	}
	if ( preg_match( '#^[a-z][a-z0-9+.-]*://#i', $source ) ) {
		return '';
	}
	return is_file( $source ) && is_readable( $source ) && '.zip' === strtolower( substr( $source, -4 ) ) ? $source : '';
}

function captain_plugins_setup_plugins(): array {
	$custom_source = captain_plugins_setup_plugin_source();
	return array(
		'woocommerce' => array(
			'name' => 'WooCommerce',
			'dir' => 'woocommerce',
			'file' => 'woocommerce/woocommerce.php',
			'source' => 'wporg',
			'checked' => true,
			'description' => __( 'Shop, Warenkorb, Kasse und Produktverwaltung. Für Lizenzprodukte und den Verkauf erforderlich.', 'captain-plugins' ),
		),
		'wordpress-seo' => array(
			'name' => 'Yoast SEO',
			'dir' => 'wordpress-seo',
			'file' => 'wordpress-seo/wp-seo.php',
			'source' => 'wporg',
			'checked' => false,
			'description' => __( 'Optional. Die Textvorlagen enthalten SEO-Titel, Meta-Beschreibungen und Fokus-Keyphrases, die bei aktiver Yoast-Installation übernommen werden.', 'captain-plugins' ),
		),
		'wp-license' => array(
			'name' => 'License Captain',
			'dir' => 'wp-license',
			'file' => 'wp-license/wp-license.php',
			'source' => 'custom',
			'package' => $custom_source,
			'checked' => '' !== $custom_source,
			'description' => __( 'License-Captain-Server für diesen Shop. Er stellt die Lizenzen für die Captain-Pro-Add-ons aus; der Client ist in den Pro-Add-ons enthalten. Die Plugin-ZIP wird aus Sicherheitsgründen nicht im Theme mitgeliefert.', 'captain-plugins' ),
		),
	);
}

function captain_plugins_setup_installed_plugins(): array {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	return get_plugins();
}

function captain_plugins_setup_plugin_file( array $definition ): string {
	$installed = captain_plugins_setup_installed_plugins();
	if ( isset( $installed[ $definition['file'] ] ) ) {
		return (string) $definition['file'];
	}
	foreach ( $installed as $file => $data ) {
		$name = strtolower( (string) ( $data['Name'] ?? '' ) );
		if ( dirname( (string) $file ) === $definition['dir'] || ( 'wp-license' === $definition['dir'] && false !== strpos( $name, 'license captain' ) ) ) {
			return (string) $file;
		}
	}
	return '';
}

function captain_plugins_setup_plugin_rows(): array {
	$rows = array();
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	foreach ( captain_plugins_setup_plugins() as $key => $definition ) {
		$file = captain_plugins_setup_plugin_file( $definition );
		$rows[ $key ] = $definition + array(
			'key' => $key,
			'installed_file' => $file,
			'status' => '' === $file ? 'missing' : ( is_plugin_active( $file ) ? 'active' : 'installed' ),
		);
	}
	return $rows;
}

function captain_plugins_setup_wporg_package( string $slug ) {
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	$api = plugins_api(
		'plugin_information',
		array(
			'slug' => $slug,
			'fields' => array(
				'sections' => false,
				'short_description' => false,
				'icons' => false,
				'banners' => false,
				'reviews' => false,
			),
		)
	);
	if ( is_wp_error( $api ) ) {
		return $api;
	}
	$download = is_object( $api ) ? (string) ( $api->download_link ?? '' ) : '';
	return '' !== $download ? $download : new WP_Error( 'captain_setup_no_download', __( 'wordpress.org lieferte keinen Download-Link.', 'captain-plugins' ) );
}

/** Download or resolve the configured License Captain ZIP and verify its SHA-256 before installation. */
function captain_plugins_setup_custom_package() {
	$source = captain_plugins_setup_plugin_source();
	if ( '' === $source ) {
		return new WP_Error( 'captain_setup_no_source', __( 'Es ist keine sichere Installationsquelle für License Captain hinterlegt.', 'captain-plugins' ) );
	}
	$expected = defined( 'CAPTAIN_LICENSE_PLUGIN_SHA256' ) ? strtolower( trim( (string) CAPTAIN_LICENSE_PLUGIN_SHA256 ) ) : '';
	if ( preg_match( '#^https://#i', $source ) ) {
		if ( ! preg_match( '/^[a-f0-9]{64}$/', $expected ) ) {
			return new WP_Error( 'captain_setup_no_checksum', __( 'Für eine HTTPS-Downloadquelle muss CAPTAIN_LICENSE_PLUGIN_SHA256 mit dem erwarteten SHA-256-Wert in wp-config.php gesetzt sein.', 'captain-plugins' ) );
		}
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$file = download_url( $source, 300 );
		if ( is_wp_error( $file ) ) {
			return $file;
		}
		$actual = hash_file( 'sha256', $file );
		if ( ! is_string( $actual ) || ! hash_equals( $expected, strtolower( $actual ) ) ) {
			wp_delete_file( $file );
			return new WP_Error( 'captain_setup_checksum_mismatch', __( 'Die Prüfsumme des License-Captain-Pakets stimmt nicht. Es wurde nichts installiert.', 'captain-plugins' ) );
		}
		return array(
			'file' => $file,
			'temporary' => true,
		);
	}
	if ( '' !== $expected && ! hash_equals( $expected, strtolower( (string) hash_file( 'sha256', $source ) ) ) ) {
		return new WP_Error( 'captain_setup_checksum_mismatch', __( 'Die lokale Prüfsumme des License-Captain-Pakets stimmt nicht.', 'captain-plugins' ) );
	}
	return array(
		'file' => $source,
		'temporary' => false,
	);
}

function captain_plugins_setup_install_package( string $package ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/misc.php';
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	if ( ! class_exists( 'WP_Ajax_Upgrader_Skin' ) ) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
	}
	$skin     = new WP_Ajax_Upgrader_Skin();
	$upgrader = new Plugin_Upgrader( $skin );
	$result   = $upgrader->install( $package );
	if ( is_wp_error( $result ) ) {
		return $result;
	}
	if ( is_wp_error( $skin->result ) ) {
		return $skin->result;
	}
	if ( $skin->get_errors()->has_errors() ) {
		return new WP_Error( 'captain_setup_install', implode( ' ', (array) $skin->get_error_messages() ) );
	}
	if ( true !== $result ) {
		return new WP_Error( 'captain_setup_filesystem', __( 'WordPress konnte nicht in den Plugin-Ordner schreiben. Prüfe die Dateirechte oder FTP-Zugangsdaten.', 'captain-plugins' ) );
	}
	$file = (string) $upgrader->plugin_info();
	return '' !== $file ? $file : new WP_Error( 'captain_setup_missing_plugin', __( 'Im ZIP wurde keine Plugin-Hauptdatei gefunden.', 'captain-plugins' ) );
}

function captain_plugins_setup_install_plugins( array $keys ): array {
	$messages = array();
	$keys     = array_values( array_map( 'sanitize_key', $keys ) );
	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 300 ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- Some hosts disable this function.
	}
	foreach ( captain_plugins_setup_plugin_rows() as $key => $row ) {
		if ( ! in_array( $key, $keys, true ) || 'active' === $row['status'] ) {
			continue;
		}
		if ( ! current_user_can( 'activate_plugins' ) ) {
			/* translators: %s: plugin name. */
			$messages[] = array( 'error', sprintf( __( '%s: Dein Benutzerkonto darf keine Plugins aktivieren.', 'captain-plugins' ), $row['name'] ) );
			continue;
		}
		$file = (string) $row['installed_file'];
		if ( '' === $file ) {
			if ( ! wp_is_file_mod_allowed( 'captain_plugins_setup' ) || ! current_user_can( 'install_plugins' ) ) {
				/* translators: %s: plugin name. */
				$messages[] = array( 'error', sprintf( __( '%s konnte nicht installiert werden: Plugin-Installation ist auf dieser Website nicht erlaubt.', 'captain-plugins' ), $row['name'] ) );
				continue;
			}
			if ( 'wporg' === $row['source'] ) {
				$package = captain_plugins_setup_wporg_package( (string) $row['dir'] );
				if ( is_wp_error( $package ) ) {
					/* translators: 1: plugin name, 2: error message. */
					$messages[] = array( 'error', sprintf( __( '%1$s: %2$s', 'captain-plugins' ), $row['name'], $package->get_error_message() ) );
					continue;
				}
				$file = captain_plugins_setup_install_package( $package );
			} else {
				$package = captain_plugins_setup_custom_package();
				if ( is_wp_error( $package ) ) {
					/* translators: 1: plugin name, 2: error message. */
					$messages[] = array( 'error', sprintf( __( '%1$s: %2$s', 'captain-plugins' ), $row['name'], $package->get_error_message() ) );
					continue;
				}
				$file = captain_plugins_setup_install_package( $package['file'] );
				if ( ! empty( $package['temporary'] ) && is_file( $package['file'] ) ) {
					wp_delete_file( $package['file'] );
				}
			}
			if ( is_wp_error( $file ) ) {
				/* translators: 1: plugin name, 2: error message. */
				$messages[] = array( 'error', sprintf( __( '%1$s konnte nicht installiert werden: %2$s', 'captain-plugins' ), $row['name'], $file->get_error_message() ) );
				continue;
			}
			/* translators: %s: plugin name. */
			$messages[] = array( 'success', sprintf( __( '%s wurde installiert.', 'captain-plugins' ), $row['name'] ) );
		}
		$activated = activate_plugin( $file );
		if ( is_wp_error( $activated ) && 'unexpected_output' !== $activated->get_error_code() ) {
			/* translators: 1: plugin name, 2: error message. */
			$messages[] = array( 'error', sprintf( __( '%1$s konnte nicht aktiviert werden: %2$s', 'captain-plugins' ), $row['name'], $activated->get_error_message() ) );
			continue;
		}
		if ( 'woocommerce' === $key ) {
			delete_transient( '_wc_activation_redirect' );
		}
		if ( 'wordpress-seo' === $key && class_exists( 'WPSEO_Options' ) && method_exists( 'WPSEO_Options', 'set' ) ) {
			WPSEO_Options::set( 'should_redirect_after_install_free', false );
		}
		/* translators: %s: plugin name. */
		$messages[] = array( 'success', sprintf( __( '%s wurde aktiviert.', 'captain-plugins' ), $row['name'] ) );
	}
	if ( empty( $messages ) ) {
		$messages[] = array( 'info', __( 'Keine Plugins ausgewählt bzw. alle ausgewählten Plugins sind bereits aktiv.', 'captain-plugins' ) );
	}
	return $messages;
}

function captain_plugins_setup_flash( array $messages ): void {
	set_transient( 'captain_plugins_setup_flash_' . get_current_user_id(), $messages, 5 * MINUTE_IN_SECONDS );
}

add_action(
	'admin_post_captain_plugins_setup_plugins',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Keine Berechtigung.', 'captain-plugins' ), '', array( 'response' => 403 ) );
		}
		check_admin_referer( 'captain_plugins_setup_plugins' );
		$selected = isset( $_POST['cp_plugins'] ) && is_array( $_POST['cp_plugins'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['cp_plugins'] ) ) : array();
		captain_plugins_setup_flash( captain_plugins_setup_install_plugins( $selected ) );
		wp_safe_redirect( captain_plugins_setup_url() . '#cp-setup-plugins' );
		exit;
	}
);

add_action(
	'admin_post_captain_plugins_setup_content',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Keine Berechtigung.', 'captain-plugins' ), '', array( 'response' => 403 ) );
		}
		check_admin_referer( 'captain_plugins_setup_content' );
		$groups = isset( $_POST['cp_groups'] ) && is_array( $_POST['cp_groups'] ) ? array_map( 'sanitize_key', wp_unslash( $_POST['cp_groups'] ) ) : array();
		$publish = ! empty( $_POST['cp_publish_pages'] );
		$counts  = captain_plugins_content_sync( $groups, $publish );
		/* translators: 1: created, 2: updated, 3: unchanged, 4: kept because edited, 5: protected by placeholders, 6: errors, 7: retired pages. */
		$messages = array( array( empty( $counts['errors'] ) ? 'success' : 'warning', sprintf( __( 'Seitenabgleich: %1$d neu angelegt, %2$d aktualisiert, %3$d unverändert, %4$d wegen eigener Änderungen geschont, %5$d mit Platzhaltern geschützt, %6$d Fehler, %7$d nicht mehr gelieferte Seiten auf Entwurf gesetzt.', 'captain-plugins' ), $counts['created'], $counts['updated'], $counts['unchanged'], $counts['edited'], $counts['blocked'], $counts['errors'], $counts['retired'] ?? 0 ) ) );
		captain_plugins_setup_flash( $messages );
		wp_safe_redirect( captain_plugins_setup_url() . '#cp-setup-content' );
		exit;
	}
);

add_action(
	'admin_post_captain_plugins_setup_products',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) || ! current_user_can( 'manage_woocommerce' ) ) {
			wp_die( esc_html__( 'Keine Berechtigung zum Verwalten von WooCommerce-Produkten.', 'captain-plugins' ), '', array( 'response' => 403 ) );
		}
		check_admin_referer( 'captain_plugins_setup_products' );
		$result = captain_plugins_setup_create_products();
		$messages = array();
		/* translators: 1: created, 2: license plans mapped, 3: already set up, 4: skipped, 5: errors. */
		$messages[] = array( empty( $result['errors'] ) ? 'success' : 'warning', sprintf( __( 'Produktentwürfe: %1$d angelegt, %2$d Lizenzpläne verknüpft, %3$d bereits eingerichtet, %4$d übersprungen, %5$d Fehler.', 'captain-plugins' ), $result['created'], $result['mapped'], $result['existing'], $result['skipped'], $result['errors'] ) );
		foreach ( $result['messages'] as $message ) {
			$messages[] = array( 'info', $message );
		}
		captain_plugins_setup_flash( $messages );
		wp_safe_redirect( captain_plugins_setup_url() . '#cp-setup-products' );
		exit;
	}
);

function captain_plugins_setup_status_label( string $status ): string {
	$labels = array(
		'active' => __( 'aktiv', 'captain-plugins' ),
		'installed' => __( 'installiert, nicht aktiv', 'captain-plugins' ),
		'missing' => __( 'nicht installiert', 'captain-plugins' ),
	);
	return $labels[ $status ] ?? $status;
}

function captain_plugins_setup_plugin_card(): void {
	$rows = captain_plugins_setup_plugin_rows();
	echo '<section class="card" id="cp-setup-plugins"><h2>' . esc_html__( '1. Plugins auswählen', 'captain-plugins' ) . '</h2><p>' . esc_html__( 'Wähle aus, welche Plugins WordPress installieren und aktivieren soll. WooCommerce ist Voraussetzung für Shop und Lizenzprodukte; Yoast SEO bleibt optional.', 'captain-plugins' ) . '</p>';
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="captain_plugins_setup_plugins">';
	wp_nonce_field( 'captain_plugins_setup_plugins' );
	echo '<table class="widefat striped"><thead><tr><th></th><th>' . esc_html__( 'Plugin', 'captain-plugins' ) . '</th><th>' . esc_html__( 'Status', 'captain-plugins' ) . '</th></tr></thead><tbody>';
	$can_install = current_user_can( 'install_plugins' ) && wp_is_file_mod_allowed( 'captain_plugins_setup' );
	foreach ( $rows as $key => $row ) {
		$enabled = 'active' !== $row['status'] && ( 'installed' === $row['status'] || ( $can_install && ( 'wporg' === $row['source'] || '' !== $row['package'] ) ) );
		$checked = $enabled && ! empty( $row['checked'] );
		$checkbox = $enabled ? '<input type="checkbox" name="cp_plugins[]" value="' . esc_attr( $key ) . '" id="cp-plugin-' . esc_attr( $key ) . '"' . checked( $checked, true, false ) . '>' : '';
		$extra = '';
		if ( 'missing' === $row['status'] && 'custom' === $row['source'] && '' === $row['package'] ) {
			$extra = esc_html__( 'Kein öffentliches wordpress.org-Paket ist hinterlegt. Konfiguriere eine vertrauenswürdige HTTPS-ZIP plus SHA-256 in wp-config.php oder lade die freigegebene ZIP über den WordPress-Plugin-Uploader hoch.', 'captain-plugins' );
			if ( current_user_can( 'upload_plugins' ) && $can_install ) {
				$extra .= ' <a href="' . esc_url( admin_url( 'plugin-install.php?tab=upload' ) ) . '">' . esc_html__( 'Plugin-ZIP hochladen', 'captain-plugins' ) . '</a>';
			}
		} elseif ( ! $enabled && 'active' !== $row['status'] ) {
			$extra = esc_html__( 'Installation oder Aktivierung ist für dieses Benutzerkonto bzw. Deployment gesperrt.', 'captain-plugins' );
		}
		echo '<tr><td>' . wp_kses(
			$checkbox,
			array(
				'input' => array(
					'type' => true,
					'name' => true,
					'value' => true,
					'id' => true,
					'checked' => true,
				),
			)
		) . '</td><td><label for="cp-plugin-' . esc_attr( $key ) . '"><strong>' . esc_html( $row['name'] ) . '</strong></label><br><span class="description">' . esc_html( $row['description'] ) . '</span>' . ( '' !== $extra ? '<br><small>' . wp_kses_post( $extra ) . '</small>' : '' ) . '</td><td>' . esc_html( captain_plugins_setup_status_label( $row['status'] ) ) . '</td></tr>';
	}
	echo '</tbody></table><p><button class="button button-primary" type="submit">' . esc_html__( 'Auswahl installieren und aktivieren', 'captain-plugins' ) . '</button> <span class="description">' . esc_html__( 'Reihenfolge: WooCommerce, Yoast SEO, License Captain.', 'captain-plugins' ) . '</span></p></form></section>';
}

function captain_plugins_setup_content_card(): void {
	$manifest = captain_plugins_content_manifest();
	$counts   = array(
		'core' => 0,
		'products' => 0,
		'guides' => 0,
	);
	foreach ( $manifest as $entry ) {
		$group = (string) ( $entry['group'] ?? '' );
		if ( isset( $counts[ $group ] ) ) {
			++$counts[ $group ];
		}
	}
	echo '<section class="card" id="cp-setup-content"><h2>' . esc_html__( '2. Website-Texte auswählen', 'captain-plugins' ) . '</h2><p>' . esc_html__( 'Der Theme-Entwurf enthält Startseite, Produktseiten, Unterseiten, Dokumentation, FAQ, Support, Lösungen und Ratgeber. Eigene Seiten werden nicht ersetzt. Bereits importierte, unveränderte Theme-Seiten können aktualisiert werden; manuell bearbeitete Seiten bleiben erhalten.', 'captain-plugins' ) . '</p>';
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="captain_plugins_setup_content">';
	wp_nonce_field( 'captain_plugins_setup_content' );
	$labels = array(
		'core' => __( 'Startseite und Website-Grundseiten', 'captain-plugins' ),
		'products' => __( 'Produktseiten, Features, Pro und Dokumentation', 'captain-plugins' ),
		'guides' => __( 'Ratgeber', 'captain-plugins' ),
	);
	foreach ( $labels as $group => $label ) {
		echo '<p><label><input type="checkbox" name="cp_groups[]" value="' . esc_attr( $group ) . '" checked> <strong>' . esc_html( $label ) . '</strong> <span class="description">(' . absint( $counts[ $group ] ) . ' Vorlagen)</span></label></p>';
	}
	echo '<p><label><input type="checkbox" name="cp_publish_pages" value="1" checked> ' . esc_html__( 'Vollständige Vorlagen veröffentlichen; Vorlagen mit Download-, Checkout-, Screenshot- oder Betreiberplatzhaltern automatisch als Entwurf anlegen.', 'captain-plugins' ) . '</label></p>';
	echo '<p class="description">' . esc_html__( 'SEO-Titel, Meta-Beschreibung und Fokus-Keyphrase werden in Yoast übernommen, wenn Yoast aktiv ist. Ohne Yoast speichert das Theme die Basis-Metadaten. Es werden keine von dir geänderten Text- oder SEO-Felder überschrieben.', 'captain-plugins' ) . '</p>';
	echo '<p><button class="button button-primary" type="submit">' . esc_html__( 'Ausgewählte Texte übernehmen', 'captain-plugins' ) . '</button></p></form></section>';
}

function captain_plugins_setup_product_card(): void {
	$woocommerce = class_exists( 'WooCommerce' );
	$license     = class_exists( '\\WPLC\\Catalog\\Catalog' );
	echo '<section class="card" id="cp-setup-products"><h2>' . esc_html__( '3. WooCommerce-Produkte anlegen', 'captain-plugins' ) . '</h2><p>' . esc_html( sprintf( /* translators: %d: number of annual plans. */ __( 'Der Assistent kann die %d aktuell definierten jährlichen Captain-Pro-Pläne als virtuelle, verborgene WooCommerce-Entwürfe anlegen und mit License Captain verknüpfen. Alle derzeit bepreisten Captain-Pro-Editionen mit festgelegten Tarifen werden angelegt; noch nicht bepreiste Review- und Course-Captain-Pläne bleiben ausgenommen. Es werden keine Produkte veröffentlicht, keine Shop-Steuern geändert und keine Dateien zum Direktdownload eingetragen.', 'captain-plugins' ), count( captain_plugins_setup_plan_rows() ) ) ) . '</p>';
	echo '<table class="widefat striped"><thead><tr><th>' . esc_html__( 'Lizenzprodukt', 'captain-plugins' ) . '</th><th>' . esc_html__( 'Plan', 'captain-plugins' ) . '</th><th>' . esc_html__( 'Jahrespreis', 'captain-plugins' ) . '</th><th>' . esc_html__( 'Live-Websites', 'captain-plugins' ) . '</th></tr></thead><tbody>';
	foreach ( captain_plugins_setup_plan_rows() as $row ) {
		echo '<tr><td>' . esc_html( $row['product_name'] ) . '</td><td>' . esc_html( ucfirst( $row['plan_key'] ) ) . '</td><td>' . esc_html( number_format_i18n( (float) $row['price'], 0 ) . ' € / Jahr' ) . '</td><td>' . absint( $row['limit'] ) . '</td></tr>';
	}
	echo '</tbody></table>';
	if ( ! $woocommerce ) {
		echo '<p class="notice notice-warning inline"><span>' . esc_html__( 'Aktiviere zuerst WooCommerce.', 'captain-plugins' ) . '</span></p>';
	} elseif ( ! $license ) {
		echo '<p class="notice notice-warning inline"><span>' . esc_html__( 'Aktiviere zuerst License Captain. Der Shop braucht den Lizenzserver, damit Käufer nach dem Kauf einen Lizenzplan erhalten.', 'captain-plugins' ) . '</span></p>';
	} elseif ( 'EUR' !== strtoupper( (string) get_option( 'woocommerce_currency', 'USD' ) ) ) {
		echo '<p class="notice notice-warning inline"><span>' . esc_html__( 'Die Konzeptbeträge sind Euro-Preise. WooCommerce steht aktuell nicht auf EUR; die Produktentwürfe werden deshalb nicht angelegt.', 'captain-plugins' ) . '</span></p>';
	} elseif ( current_user_can( 'manage_woocommerce' ) ) {
		echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="captain_plugins_setup_products">';
		wp_nonce_field( 'captain_plugins_setup_products' );
		echo '<p><button class="button button-primary" type="submit">' . esc_html( sprintf( /* translators: %d: number of product drafts. */ __( '%d Produktentwürfe und Lizenzpläne anlegen', 'captain-plugins' ), count( captain_plugins_setup_plan_rows() ) ) ) . '</button></p></form>';
	} else {
		echo '<p class="notice notice-warning inline"><span>' . esc_html__( 'Dein Benutzerkonto darf keine WooCommerce-Produkte verwalten.', 'captain-plugins' ) . '</span></p>';
	}
	echo '<p class="description">' . esc_html__( 'Der License-Captain-Server muss aktiv sein, damit die Pro-Jahrespläne dieser Website als Lizenzprodukte zugeordnet werden. Kunden sehen davon nichts: Sie aktivieren ihren Lizenzschlüssel direkt im Pro-Add-on. Die erstellten Produkte bleiben Entwürfe, bis Produktdateien/Release-Bereitstellung, Steuern, Checkout, Lizenzserver und Supportangaben geprüft sind.', 'captain-plugins' ) . '</p></section>';
}

function captain_plugins_setup_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Keine Berechtigung.', 'captain-plugins' ), '', array( 'response' => 403 ) );
	}
	echo '<div class="wrap cp-setup"><h1>' . esc_html__( 'Captain Plugins einrichten', 'captain-plugins' ) . '</h1><p>' . esc_html__( 'Wähle die Bausteine für deine Website. Der Assistent verändert bestehende Texte und Shop-Einstellungen nicht stillschweigend.', 'captain-plugins' ) . '</p>';
	echo '<style>.cp-setup .card{max-width:1050px;padding:1rem 1.4rem 1.2rem;margin:1.2rem 0}.cp-setup td{vertical-align:top}.cp-setup .notice.inline{padding:.6em 1em}.cp-setup small{display:inline-block;margin-top:.35em}</style>';
	$flash_key = 'captain_plugins_setup_flash_' . get_current_user_id();
	$flash = get_transient( $flash_key );
	if ( is_array( $flash ) ) {
		delete_transient( $flash_key );
		foreach ( $flash as $message ) {
			$type = in_array( $message[0] ?? '', array( 'success', 'error', 'warning', 'info' ), true ) ? $message[0] : 'info';
			echo '<div class="notice notice-' . esc_attr( $type ) . ' is-dismissible"><p>' . esc_html( (string) ( $message[1] ?? '' ) ) . '</p></div>';
		}
	}
	captain_plugins_setup_plugin_card();
	captain_plugins_setup_content_card();
	captain_plugins_setup_product_card();
	echo '<section class="card"><h2>' . esc_html__( '4. Vor dem Verkaufsstart', 'captain-plugins' ) . '</h2><p>' . esc_html__( 'Ergänze und prüfe Unternehmensangaben, Steuer- und Zahlungsverfahren, Lizenzserver-Schlüssel, Produkt-Releases und Downloads. Dieser Assistent ändert keine Steuer-, Zahlungs-, Vertrags- oder Rechtseinstellungen automatisch.', 'captain-plugins' ) . '</p></section></div>';
}
