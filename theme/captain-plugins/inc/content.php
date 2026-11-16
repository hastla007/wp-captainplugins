<?php
/**
 * Install and safely synchronize the site copy bundled with the theme.
 *
 * @package CaptainPlugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function captain_plugins_content_manifest(): array {
	$file = get_theme_file_path( 'content/pages.php' );
	if ( ! is_readable( $file ) ) {
		return array();
	}
	$pages = require $file;
	return is_array( $pages ) ? $pages : array();
}

function captain_plugins_content_template( array $entry ): ?string {
	$file = basename( (string) ( $entry['file'] ?? '' ) );
	if ( ! preg_match( '/^[a-f0-9]{8}-[a-z0-9-]+\.html$/', $file ) ) {
		return null;
	}
	$path = get_theme_file_path( 'content/pages/' . $file );
	if ( ! is_readable( $path ) ) {
		return null;
	}
	return trim( (string) file_get_contents( $path ) );
}

function captain_plugins_content_page_hash( WP_Post $page ): string {
	return hash( 'sha256', trim( (string) $page->post_title ) . "\n" . trim( (string) $page->post_content ) );
}

function captain_plugins_content_is_placeholder( string $content, array $entry ): bool {
	if ( ! empty( $entry['has_placeholders'] ) ) {
		return true;
	}
	return (bool) preg_match( '/\[(?:Download|Checkout|Support|Screenshot|Demo|Kundenbeispiel)[^\]]*\]|\[\[(?:Betreiber|Platzhalter)[^\]]*\]\]/i', $content );
}

function captain_plugins_content_seo_values( array $entry ): array {
	return array(
		'_cp_seo_title'       => (string) ( $entry['seo_title'] ?? '' ),
		'_cp_meta_description' => (string) ( $entry['meta_description'] ?? '' ),
		'_cp_focus_keyphrase'  => (string) ( $entry['focus_keyphrase'] ?? '' ),
	);
}

/** Pick a relevant registered block template for imported page types. */
function captain_plugins_content_template_slug( array $entry ): string {
	$path = trim( (string) ( $entry['path'] ?? '' ), '/' );
	if ( '' === $path ) {
		return '';
	}
	// Product start pages are top-level "*-captain" pages; their content carries the product hero and H1.
	if ( preg_match( '/^[a-z]+-captain$/', $path ) ) {
		return 'page-product';
	}
	if ( in_array( $path, array( 'preise', 'captain-pro' ), true ) || '/preise' === substr( $path, -7 ) ) {
		return 'page-pricing';
	}
	if ( in_array( $path, array( 'produkte', 'vergleich', 'loesungen' ), true ) ) {
		return 'page-wide';
	}
	return 'page-resource';
}

/** Assign our template only while the page still uses the default or our prior assignment. */
function captain_plugins_content_store_template( int $post_id, array $entry ): void {
	$desired = captain_plugins_content_template_slug( $entry );
	if ( '' === $desired ) {
		return;
	}
	$current = (string) get_post_meta( $post_id, '_wp_page_template', true );
	$written = (string) get_post_meta( $post_id, '_cp_page_template_written', true );
	if ( ( '' === $current && '' === $written ) || ( '' !== $written && $current === $written ) ) {
		update_post_meta( $post_id, '_wp_page_template', $desired );
		update_post_meta( $post_id, '_cp_page_template_written', $desired );
	}
}

/** Write SEO defaults without replacing fields a site owner has changed. */
function captain_plugins_content_store_seo( int $post_id, array $entry, bool $force = false ): void {
	$values = captain_plugins_content_seo_values( $entry );
	$last   = get_post_meta( $post_id, '_cp_seo_written', true );
	$last   = is_array( $last ) ? $last : array();
	foreach ( $values as $key => $value ) {
		$current = (string) get_post_meta( $post_id, $key, true );
		if ( $force || '' === $current || ( isset( $last[ $key ] ) && $current === (string) $last[ $key ] ) ) {
			'' === $value ? delete_post_meta( $post_id, $key ) : update_post_meta( $post_id, $key, $value );
		}
	}
	update_post_meta( $post_id, '_cp_seo_written', $values );

	if ( defined( 'WPSEO_VERSION' ) ) {
		// Manifest fields exist but may be empty strings; fall back to the SEO values in that case.
		$social_title = (string) ( ( $entry['social_title'] ?? '' ) ?: ( $entry['seo_title'] ?? '' ) );
		$social_desc  = (string) ( ( $entry['social_description'] ?? '' ) ?: ( $entry['meta_description'] ?? '' ) );
		$yoast = array(
			'_yoast_wpseo_title'    => (string) ( $entry['seo_title'] ?? '' ),
			'_yoast_wpseo_metadesc' => (string) ( $entry['meta_description'] ?? '' ),
			'_yoast_wpseo_focuskw'  => (string) ( $entry['focus_keyphrase'] ?? '' ),
			'_yoast_wpseo_opengraph-title' => $social_title,
			'_yoast_wpseo_opengraph-description' => $social_desc,
			'_yoast_wpseo_twitter-title' => $social_title,
			'_yoast_wpseo_twitter-description' => $social_desc,
		);
		if ( ! empty( $entry['social_image'] ) ) {
			$yoast['_yoast_wpseo_opengraph-image'] = esc_url_raw( (string) $entry['social_image'] );
			$yoast['_yoast_wpseo_twitter-image']   = esc_url_raw( (string) $entry['social_image'] );
		}
		$written = get_post_meta( $post_id, '_cp_yoast_written', true );
		$written = is_array( $written ) ? $written : array();
		foreach ( $yoast as $key => $value ) {
			$current = (string) get_post_meta( $post_id, $key, true );
			if ( $force || '' === $current || ( isset( $written[ $key ] ) && $current === (string) $written[ $key ] ) ) {
				'' === $value ? delete_post_meta( $post_id, $key ) : update_post_meta( $post_id, $key, $value );
			}
		}
		update_post_meta( $post_id, '_cp_yoast_written', $yoast );
	}
}

function captain_plugins_content_store_meta( int $post_id, array $entry, string $source_hash, string $status ): void {
	$page = get_post( $post_id );
	if ( ! $page instanceof WP_Post ) {
		return;
	}
	update_post_meta( $post_id, '_cp_theme_page', '1' );
	update_post_meta( $post_id, '_cp_content_hash', captain_plugins_content_page_hash( $page ) );
	update_post_meta( $post_id, '_cp_content_source', $source_hash );
	update_post_meta( $post_id, '_cp_content_status', $status );
	update_post_meta( $post_id, '_cp_content_path', (string) ( $entry['path'] ?? '' ) );
	captain_plugins_content_store_template( $post_id, $entry );
	captain_plugins_content_store_seo( $post_id, $entry );
}

/**
 * Create or update only unchanged theme pages. Human edits and unrelated pages are left intact.
 *
 * @return array<string,int> Result counts.
 */
function captain_plugins_content_sync( array $groups, bool $publish = true ): array {
	$allowed = array( 'core', 'products', 'guides' );
	$groups  = array_values( array_intersect( $allowed, array_map( 'sanitize_key', $groups ) ) );
	if ( empty( $groups ) ) {
		return array( 'created' => 0, 'updated' => 0, 'unchanged' => 0, 'edited' => 0, 'blocked' => 0, 'errors' => 1 );
	}
	$entries = captain_plugins_content_manifest();
	$selected = array();
	$by_path  = array();
	foreach ( $entries as $entry ) {
		$path = trim( (string) ( $entry['path'] ?? '' ), '/' );
		$by_path[ $path ] = $entry;
		if ( in_array( (string) ( $entry['group'] ?? '' ), $groups, true ) ) {
			$selected[ $path ] = $entry;
			$parent = (string) ( $entry['parent'] ?? '' );
			while ( '' !== $parent && isset( $by_path[ $parent ] ) ) {
				$selected[ $parent ] = $by_path[ $parent ];
				$parent = (string) ( $by_path[ $parent ]['parent'] ?? '' );
			}
		}
	}
	// Manifest is parent-first; add any ancestor not yet in the selection after the lookup pass.
	foreach ( $entries as $entry ) {
		$path = trim( (string) ( $entry['path'] ?? '' ), '/' );
		if ( isset( $selected[ $path ] ) ) {
			continue;
		}
		foreach ( $selected as $selected_entry ) {
			if ( trim( (string) ( $selected_entry['parent'] ?? '' ), '/' ) === $path ) {
				$selected[ $path ] = $entry;
				break;
			}
		}
	}
	$counts = array( 'created' => 0, 'updated' => 0, 'unchanged' => 0, 'edited' => 0, 'blocked' => 0, 'errors' => 0 );

	foreach ( $entries as $entry ) {
		$path = trim( (string) ( $entry['path'] ?? '' ), '/' );
		if ( ! isset( $selected[ $path ] ) ) {
			continue;
		}
		$template = captain_plugins_content_template( $entry );
		if ( null === $template ) {
			++$counts['errors'];
			continue;
		}
		$title       = sanitize_text_field( (string) ( $entry['title'] ?? '' ) );
		$source_hash = (string) ( $entry['source_hash'] ?? hash( 'sha256', $template . $title ) );
		$placeholder = captain_plugins_content_is_placeholder( $template, $entry );
		$wanted_status = ( $placeholder || ! $publish ) ? 'draft' : 'publish';

		if ( '' === $path ) {
			$front_id = 'page' === get_option( 'show_on_front' ) ? absint( get_option( 'page_on_front' ) ) : 0;
			$page = $front_id ? get_post( $front_id ) : null;
			if ( ! $page instanceof WP_Post ) {
				$page = get_page_by_path( 'startseite', OBJECT, 'page' );
			}
			if ( $page instanceof WP_Post && '1' !== get_post_meta( $page->ID, '_cp_theme_page', true ) ) {
				// Use an existing static front page for SEO defaults, but never replace its contents.
				captain_plugins_content_store_seo( (int) $page->ID, $entry );
				++$counts['unchanged'];
				continue;
			}
			if ( ! $page instanceof WP_Post ) {
				$id = wp_insert_post( wp_slash( array(
					'post_type' => 'page', 'post_status' => $wanted_status, 'post_title' => $title ?: __( 'Startseite', 'captain-plugins' ),
					'post_name' => 'startseite', 'post_content' => $template, 'comment_status' => 'closed', 'ping_status' => 'closed',
				) ), true );
				if ( is_wp_error( $id ) || ! $id ) {
					++$counts['errors'];
					continue;
				}
				$page = get_post( (int) $id );
				if ( 'publish' === $wanted_status ) {
					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', (int) $id );
				}
				captain_plugins_content_store_meta( (int) $id, $entry, $source_hash, $wanted_status );
				++$counts['created'];
				continue;
			}
			$page_id = (int) $page->ID;
			$source  = (string) get_post_meta( $page_id, '_cp_content_source', true );
			$known   = '1' === get_post_meta( $page_id, '_cp_theme_page', true );
			$untouched = $known && hash_equals( (string) get_post_meta( $page_id, '_cp_content_hash', true ), captain_plugins_content_page_hash( $page ) );
			if ( $untouched && $source === $source_hash ) {
				captain_plugins_content_store_template( $page_id, $entry );
				captain_plugins_content_store_seo( $page_id, $entry );
				++$counts['unchanged'];
				continue;
			}
			if ( ! $untouched ) {
				captain_plugins_content_store_seo( $page_id, $entry );
				++$counts['edited'];
				continue;
			}
			if ( $placeholder && 'publish' === $page->post_status ) {
				++$counts['blocked'];
				continue;
			}
			$id = wp_update_post( wp_slash( array( 'ID' => $page_id, 'post_title' => $title, 'post_content' => $template, 'post_status' => $placeholder ? 'draft' : $page->post_status ) ), true );
			if ( is_wp_error( $id ) || ! $id ) {
				++$counts['errors'];
				continue;
			}
			captain_plugins_content_store_meta( $page_id, $entry, $source_hash, $page->post_status );
			++$counts['updated'];
			continue;
		}

		$parent_path = trim( (string) ( $entry['parent'] ?? '' ), '/' );
		$parent_id   = 0;
		if ( '' !== $parent_path ) {
			$parent = get_page_by_path( $parent_path, OBJECT, 'page' );
			if ( ! $parent instanceof WP_Post ) {
				++$counts['errors'];
				continue;
			}
			$parent_id = (int) $parent->ID;
		}
		$page = get_page_by_path( $path, OBJECT, 'page' );
		if ( ! $page instanceof WP_Post ) {
			$id = wp_insert_post( wp_slash( array(
				'post_type' => 'page', 'post_status' => $wanted_status, 'post_title' => $title,
				'post_name' => (string) ( $entry['slug'] ?? '' ), 'post_parent' => $parent_id,
				'post_content' => $template, 'menu_order' => (int) ( $entry['order'] ?? 0 ),
				'comment_status' => 'closed', 'ping_status' => 'closed',
			) ), true );
			if ( is_wp_error( $id ) || ! $id ) {
				++$counts['errors'];
				continue;
			}
			captain_plugins_content_store_meta( (int) $id, $entry, $source_hash, $wanted_status );
			++$counts['created'];
			continue;
		}
		$page_id = (int) $page->ID;
		$known   = '1' === get_post_meta( $page_id, '_cp_theme_page', true );
		$source  = (string) get_post_meta( $page_id, '_cp_content_source', true );
		$untouched = $known && hash_equals( (string) get_post_meta( $page_id, '_cp_content_hash', true ), captain_plugins_content_page_hash( $page ) );
		if ( $untouched && $source === $source_hash ) {
			captain_plugins_content_store_template( $page_id, $entry );
			captain_plugins_content_store_seo( $page_id, $entry );
			++$counts['unchanged'];
			continue;
		}
		if ( ! $untouched ) {
			captain_plugins_content_store_seo( $page_id, $entry );
			++$counts['edited'];
			continue;
		}
		if ( $placeholder && 'publish' === $page->post_status ) {
			++$counts['blocked'];
			continue;
		}
		$old_status = $page->post_status;
		$status      = $placeholder ? 'draft' : ( 'draft' === $old_status && 'publish' === $wanted_status ? 'publish' : $old_status );
		$id = wp_update_post( wp_slash( array(
			'ID' => $page_id, 'post_title' => $title, 'post_content' => $template, 'post_parent' => $parent_id,
			'post_status' => $status,
		) ), true );
		if ( is_wp_error( $id ) || ! $id ) {
			++$counts['errors'];
			continue;
		}
		captain_plugins_content_store_meta( $page_id, $entry, $source_hash, $status );
		++$counts['updated'];
	}

	return $counts;
}
