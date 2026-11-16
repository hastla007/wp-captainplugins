<?php
/**
 * Integration tests for the Captain Plugins theme logic.
 * Usage: php tests/run.php /path/to/wordpress/wp-load.php
 * Needs a disposable WordPress test installation with the theme active. Test pages are removed afterwards.
 */
if ( empty( $argv[1] ) || ! is_readable( $argv[1] ) ) {
	fwrite( STDERR, "Aufruf: php tests/run.php /pfad/zu/wp-load.php\n" );
	exit( 2 );
}
$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'localhost';
require $argv[1];
wp_set_current_user( 1 );

$passed  = 0;
$failed  = array();
$cleanup = array();
function check( string $name, bool $ok, string $detail = '' ): void {
	global $passed, $failed;
	if ( $ok ) {
		++$passed;
		echo "  ✓ $name\n";
	} else {
		$failed[] = $name;
		echo "  ✗ $name" . ( '' !== $detail ? " – $detail" : '' ) . "\n";
	}
}
function make_page( array $args ): int {
	global $cleanup;
	$id        = (int) wp_insert_post( wp_slash( array_merge( array( 'post_type' => 'page', 'post_status' => 'publish' ), $args ) ) );
	$cleanup[] = $id;
	return $id;
}

check( 'Theme aktiv', 'captain-plugins' === get_stylesheet(), get_stylesheet() );

echo "Vorlagenzuordnung\n";
$expect = array( 'voucher-captain' => 'page-product', 'workflow-captain' => 'page-product', 'preise' => 'page-pricing', 'license-captain/preise' => 'page-pricing', 'kompatibilitaet' => 'page-wide', 'form-captain/integrationen' => 'page-wide', 'loesungen/akademien' => 'page-wide', 'faq' => 'page-resource', 'ratgeber/voucher-captain/firmenbestellungen-csv' => 'page-resource', '' => '' );
foreach ( $expect as $path => $template ) {
	$got = captain_plugins_content_template_slug( array( 'path' => $path ) );
	check( "„/{$path}“ → " . ( $template ?: 'keine' ), $got === $template, $got );
}

echo "Vorlage nur setzen, solange niemand sie geändert hat\n";
$id = make_page( array( 'post_title' => 'cp-test-vorlage', 'post_name' => 'cp-test-vorlage' ) );
captain_plugins_content_store_template( $id, array( 'path' => 'voucher-captain' ) );
check( 'Erstzuordnung', 'page-product' === get_post_meta( $id, '_wp_page_template', true ) );
update_post_meta( $id, '_wp_page_template', 'page-wide' );
captain_plugins_content_store_template( $id, array( 'path' => 'voucher-captain' ) );
check( 'manuelle Wahl bleibt', 'page-wide' === get_post_meta( $id, '_wp_page_template', true ) );

echo "Social-Bild\n";
check( 'theme:-Pfad wird zur URL', str_ends_with( captain_plugins_content_social_image( 'theme:assets/social/voucher-captain.jpg' ), '/assets/social/voucher-captain.jpg' ) );
check( 'fehlende Datei → leer', '' === captain_plugins_content_social_image( 'theme:assets/social/gibt-es-nicht.jpg' ) );
check( 'relative URL → leer', '' === captain_plugins_content_social_image( '/bild.jpg' ) );
check( 'https-URL bleibt', 'https://cdn.example.com/a.jpg' === captain_plugins_content_social_image( 'https://cdn.example.com/a.jpg' ) );

echo "Datenbank- und PHP-Prüfung\n";
foreach ( array( '9.7.0' => array( 'mysql', '9.7.0' ), '8.0.36-0ubuntu0.22.04.1' => array( 'mysql', '8.0.36' ), '5.5.5-10.11.6-MariaDB-0+deb12u1' => array( 'mariadb', '10.11.6' ), '12.3.1-MariaDB' => array( 'mariadb', '12.3.1' ) ) as $info => $want ) {
	$got = captain_plugins_parse_database_server( $info );
	check( "Server „{$info}“", array( $got['type'], $got['version'] ) === $want, implode( ' ', $got ) );
}
$issues = captain_plugins_requirement_issues();
check( 'PHP-Hinweis genau dann, wenn PHP < 8.5', version_compare( PHP_VERSION, '8.5', '<' ) === (bool) preg_grep( '/^PHP /', $issues ) );

echo "SEO-Felder\n";
$id    = make_page( array( 'post_title' => 'cp-test-seo', 'post_name' => 'cp-test-seo' ) );
$entry = array( 'seo_title' => 'Titel A', 'meta_description' => 'Beschreibung A', 'focus_keyphrase' => 'A' );
captain_plugins_content_store_seo( $id, $entry );
check( 'SEO-Titel geschrieben', 'Titel A' === get_post_meta( $id, '_cp_seo_title', true ) );
update_post_meta( $id, '_cp_seo_title', 'Von Hand' );
captain_plugins_content_store_seo( $id, array( 'seo_title' => 'Titel B' ) + $entry );
check( 'von Hand geänderter Titel bleibt', 'Von Hand' === get_post_meta( $id, '_cp_seo_title', true ) );
captain_plugins_content_store_seo( $id, array( 'meta_description' => 'Beschreibung B' ) + $entry );
check( 'unveränderte Beschreibung wird aktualisiert', 'Beschreibung B' === get_post_meta( $id, '_cp_meta_description', true ) );

echo "Titel-Fallback ohne Yoast\n";
if ( ! defined( 'WPSEO_VERSION' ) ) {
	$page = get_page_by_path( 'voucher-captain' );
	if ( $page ) {
		$GLOBALS['wp_query'] = new WP_Query( array( 'page_id' => $page->ID ) );
		$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
		$parts = apply_filters( 'document_title_parts', array( 'title' => 'x', 'site' => 'Captain Plugins' ) );
		check( 'vollständiger SEO-Titel ohne angehängten Seitennamen', ! isset( $parts['site'] ) && '' !== ( $parts['title'] ?? '' ), wp_json_encode( $parts ) );
		wp_reset_query();
	} else {
		check( 'Seite voucher-captain vorhanden (Inhalte importiert?)', false );
	}
}

echo "Ausgemusterte Seiten\n";
$parent = make_page( array( 'post_title' => 'cp-test-eltern', 'post_name' => 'cp-test-eltern' ) );
$old    = make_page( array( 'post_title' => 'Alt', 'post_name' => 'alt', 'post_parent' => $parent, 'post_content' => 'Alter Inhalt' ) );
update_post_meta( $old, '_cp_theme_page', '1' );
update_post_meta( $old, '_cp_content_hash', captain_plugins_content_page_hash( get_post( $old ) ) );
add_filter( 'theme_file_path', static function ( $path, $file ) {
	return 'content/retired.php' === $file ? sys_get_temp_dir() . '/cp-retired-test.php' : $path;
}, 10, 2 );
file_put_contents( sys_get_temp_dir() . '/cp-retired-test.php', "<?php return array( 'cp-test-eltern/alt' => '/ziel/' );" );
check( 'unveränderte Kopie → Entwurf', 1 === captain_plugins_content_retire() && 'draft' === get_post_status( $old ) );
wp_update_post( array( 'ID' => $old, 'post_status' => 'publish', 'post_content' => 'Von Hand geändert' ) );
check( 'bearbeitete Kopie bleibt online', 0 === captain_plugins_content_retire() && 'publish' === get_post_status( $old ) );
unlink( sys_get_temp_dir() . '/cp-retired-test.php' );

echo "Render-Filter\n";
$footer = captain_plugins_label_footer_nav( '<nav class="wp-block-group cp-footer-nav"><h2>Produkte</h2></nav>', array( 'attrs' => array( 'tagName' => 'nav', 'className' => 'cp-footer-nav' ) ) );
check( 'Footer-Navigation erhält Namen', str_contains( $footer, 'aria-label="Footer: Produkte"' ), $footer );
$table = captain_plugins_accessible_table( '<figure class="wp-block-table"><table><thead><tr><th>Produkt</th><th>PHP</th></tr></thead></table></figure>' );
check( 'Tabelle fokussierbar und benannt', str_contains( $table, 'tabindex="0"' ) && str_contains( $table, 'Produkt, PHP' ), $table );
$year = captain_plugins_copyright_year( '<p class="cp-copyright">© {{year}} Captain Plugins</p>', array( 'attrs' => array( 'className' => 'cp-copyright' ) ) );
check( 'Copyright-Jahr ersetzt', str_contains( $year, wp_date( 'Y' ) ) && ! str_contains( $year, '{{year}}' ) );

echo "Shop und Sitemap\n";
$placeholder = captain_plugins_product_placeholder_html( '<img src="x.png" alt="Voucher Captain Pro" width="300" height="300" />', 'thumbnail', array( 'width' => 300, 'height' => 300 ) );
check( 'Platzhalter behält Alt-Text', str_contains( $placeholder, 'alt="Voucher Captain Pro"' ) && str_contains( $placeholder, 'product-placeholder.svg' ), $placeholder );
$button = captain_plugins_account_url_token( '<a href="{{account_url}}">Konto</a>' );
check( 'Konto-Platzhalter ersetzt', ! str_contains( $button, '{{account_url}}' ) && str_contains( $button, 'href="http' ), $button );
$status = captain_plugins_order_status_title( '<div class="wc-block-order-confirmation-status"><h1>Order received</h1><p>Danke</p></div>' );
check( 'Bestellstatus: eigene H1 von WooCommerce wird Seitentitel', 1 === substr_count( $status, '<h1' ) && str_contains( $status, 'cp-page-title' ) );
$status = captain_plugins_order_status_title( '<div class="wc-block-order-confirmation-status"><p>Danke</p></div>' );
check( 'Bestellstatus ohne H1 bekommt eine', 1 === substr_count( $status, '<h1' ) );
check( 'Lizenzplan unvollständig erkannt', ! captain_plugins_setup_mapping_complete( array( 'entitlements_json' => '{"sites.live_limit":1}' ), array( 'pass.write_api' => true ) ) );
check( 'Lizenzplan vollständig erkannt', captain_plugins_setup_mapping_complete( array( 'entitlements_json' => '{"pass.write_api":true}' ), array( 'pass.write_api' => true ) ) );
check( 'Kein Gravatar im Frontend', str_contains( (string) get_avatar_url( 'kunde@example.com' ), 'avatar.svg' ) );
check( 'Kein title-tag (sonst doppelter <title> mit Yoast)', ! current_theme_supports( 'title-tag' ) );
check( 'Yoast-Sitemap ohne Autoren', array() === apply_filters( 'wpseo_sitemap_exclude_author', array( new stdClass() ) ) );
check( 'Autoren-Sitemap entfernt', false === apply_filters( 'wp_sitemaps_add_provider', new stdClass(), 'users' ) );
check( 'Seiten-Sitemap bleibt', false !== apply_filters( 'wp_sitemaps_add_provider', new stdClass(), 'posts' ) );
if ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'cart' ) > 0 ) {
	$args = apply_filters( 'wp_sitemaps_posts_query_args', array(), 'page' );
	check( 'Warenkorb nicht in der Yoast-Sitemap', in_array( (int) wc_get_page_id( 'cart' ), apply_filters( 'wpseo_exclude_from_sitemap_by_post_ids', array() ), true ) );
	check( 'Warenkorb nicht in der Sitemap', in_array( (int) wc_get_page_id( 'cart' ), (array) ( $args['post__not_in'] ?? array() ), true ) );
}

foreach ( array_reverse( $cleanup ) as $id ) {
	wp_delete_post( $id, true );
}
echo "\n$passed bestanden, " . count( $failed ) . " fehlgeschlagen\n";
exit( $failed ? 1 : 0 );
