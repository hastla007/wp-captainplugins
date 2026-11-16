<?php
/** Basic metadata fallback when Yoast SEO is not installed. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'document_title_parts', static function ( array $parts ): array {
	if ( defined( 'WPSEO_VERSION' ) || ! is_singular( 'page' ) ) {
		return $parts;
	}
	$title = (string) get_post_meta( get_queried_object_id(), '_cp_seo_title', true );
	if ( '' !== $title ) {
		// The stored SEO title is the complete document title (as in Yoast), so WordPress must not append the site name.
		$parts = array( 'title' => $title );
	}
	return $parts;
} );

add_action( 'wp_head', static function (): void {
	if ( defined( 'WPSEO_VERSION' ) || ! is_singular( 'page' ) ) {
		return;
	}
	$description = (string) get_post_meta( get_queried_object_id(), '_cp_meta_description', true );
	if ( '' !== $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
}, 2 );
