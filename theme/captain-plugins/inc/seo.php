<?php
/** Basic metadata fallback when Yoast SEO is not installed. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'document_title_parts',
	static function ( array $parts ): array {
		if ( defined( 'WPSEO_VERSION' ) || ! is_singular( 'page' ) ) {
			return $parts;
		}
		$title = (string) get_post_meta( get_queried_object_id(), '_cp_seo_title', true );
		if ( '' !== $title ) {
			// The stored SEO title is the complete document title (as in Yoast), so WordPress must not append the site name.
			$parts = array( 'title' => $title );
		}
		return $parts;
	}
);

add_action(
	'wp_head',
	static function (): void {
		if ( defined( 'WPSEO_VERSION' ) || ! is_singular( array( 'page', 'product' ) ) ) {
			return;
		}
		$description = (string) get_post_meta( get_queried_object_id(), '_cp_meta_description', true );
		if ( '' === $description && is_singular( 'product' ) ) {
			// Products: the short description (for Captain Pro: plan, sites, support) is the best summary.
			$description = wp_html_excerpt( wp_strip_all_tags( (string) get_the_excerpt( get_queried_object_id() ) ), 158, '…' );
		}
		if ( '' !== $description ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		}
	},
	2
);

/**
 * WordPress core sitemap (only used without Yoast): leave out pages that WooCommerce marks noindex
 * (cart, checkout, account), so the sitemap never contradicts the robots meta tag.
 */
add_filter(
	'wp_sitemaps_posts_query_args',
	static function ( array $args, string $post_type ): array {
		if ( 'page' !== $post_type || ! function_exists( 'wc_get_page_id' ) ) {
			return $args;
		}
		$excluded = array_filter( array_map( 'intval', array( wc_get_page_id( 'cart' ), wc_get_page_id( 'checkout' ), wc_get_page_id( 'myaccount' ) ) ), static fn( int $id ): bool => $id > 0 );
		if ( array() !== $excluded ) {
			$args['post__not_in'] = array_merge( (array) ( $args['post__not_in'] ?? array() ), $excluded );
		}
		return $args;
	},
	10,
	2
);

/** Core sitemap without author archives: they add no content here and would publish login names. */
add_filter(
	'wp_sitemaps_add_provider',
	static fn( $provider, string $name ) => 'users' === $name ? false : $provider,
	10,
	2
);
