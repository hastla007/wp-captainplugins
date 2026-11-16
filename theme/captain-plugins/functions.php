<?php
/**
 * Captain Plugins theme setup.
 *
 * @package CaptainPlugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_theme_file_path( 'inc/content.php' );
require_once get_theme_file_path( 'inc/seo.php' );
require_once get_theme_file_path( 'inc/catalog.php' );
require_once get_theme_file_path( 'inc/setup.php' );

function captain_plugins_setup() {
	load_theme_textdomain( 'captain-plugins', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/theme.css' );
	add_theme_support( 'custom-logo', array( 'height' => 64, 'width' => 220, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'woocommerce' );

	register_block_pattern_category(
		'captain-plugins',
		array(
			'label' => __( 'Captain Plugins', 'captain-plugins' ),
		)
	);
}
add_action( 'after_setup_theme', 'captain_plugins_setup' );

function captain_plugins_enqueue_styles() {
	wp_enqueue_style(
		'captain-plugins-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'captain_plugins_enqueue_styles' );

/** Build the lightweight page breadcrumb; Yoast remains responsible for structured data. */
function captain_plugins_breadcrumb_markup(): string {
	if ( ! is_page() || is_front_page() ) {
		return '';
	}
	$page = get_queried_object();
	if ( ! $page instanceof WP_Post ) {
		return '';
	}
	$items   = array();
	$items[] = '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Startseite', 'captain-plugins' ) . '</a></li>';
	foreach ( array_reverse( get_post_ancestors( $page ) ) as $ancestor_id ) {
		$ancestor = get_post( $ancestor_id );
		if ( $ancestor instanceof WP_Post && 'publish' === $ancestor->post_status ) {
			$items[] = '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
		}
	}
	$items[] = '<li aria-current="page"><span>' . esc_html( get_the_title( $page ) ) . '</span></li>';
	return '<nav class="cp-breadcrumb" aria-label="' . esc_attr__( 'Brotkrumennavigation', 'captain-plugins' ) . '"><ol>' . implode( '', $items ) . '</ol></nav>';
}

/** Print the breadcrumb only once per request. */
function captain_plugins_take_breadcrumb(): string {
	static $printed = false;
	if ( $printed ) {
		return '';
	}
	$markup = captain_plugins_breadcrumb_markup();
	if ( '' !== $markup ) {
		$printed = true;
	}
	return $markup;
}

/** Templates place the breadcrumb above the page title inside the page header band. */
function captain_plugins_breadcrumb_before_title( string $content, array $block ): string {
	$class = (string) ( $block['attrs']['className'] ?? '' );
	if ( false === strpos( $class, 'cp-page-title' ) || false !== strpos( $class, 'cp-page-title--fallback' ) ) {
		return $content;
	}
	return captain_plugins_take_breadcrumb() . $content;
}
add_filter( 'render_block_core/post-title', 'captain_plugins_breadcrumb_before_title', 10, 2 );

/** Templates without a visible title (product pages) get the breadcrumb at the start of the content. */
function captain_plugins_page_breadcrumb( string $content ): string {
	if ( is_admin() || is_feed() || ! is_page() || is_front_page() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$breadcrumb = captain_plugins_take_breadcrumb();
	return '' === $breadcrumb ? $content : '<div class="cp-breadcrumb-bar">' . $breadcrumb . '</div>' . $content;
}
add_filter( 'the_content', 'captain_plugins_page_breadcrumb', 8 );

/** front-page.html renders a static page; without one, fall back to the posts index templates. */
function captain_plugins_front_page_hierarchy( array $templates ): array {
	return 'page' === get_option( 'show_on_front' ) ? $templates : array();
}
add_filter( 'frontpage_template_hierarchy', 'captain_plugins_front_page_hierarchy' );

/** Name each footer navigation landmark after its column heading so screen readers can tell them apart. */
function captain_plugins_label_footer_nav( string $content, array $block ): string {
	if ( 'nav' !== ( $block['attrs']['tagName'] ?? '' ) || false === strpos( (string) ( $block['attrs']['className'] ?? '' ), 'cp-footer-nav' ) || false !== strpos( $content, 'aria-label=' ) ) {
		return $content;
	}
	if ( ! preg_match( '#<h[2-6][^>]*>(.*?)</h[2-6]>#s', $content, $heading ) ) {
		return $content;
	}
	/* translators: %s: footer column heading, e.g. "Produkte". */
	$label = sprintf( __( 'Footer: %s', 'captain-plugins' ), wp_strip_all_tags( $heading[1] ) );
	return (string) preg_replace( '/<nav\b/', '<nav aria-label="' . esc_attr( $label ) . '"', $content, 1 );
}
add_filter( 'render_block_core/group', 'captain_plugins_label_footer_nav', 10, 2 );

/** Keep the footer copyright year current without a placeholder in the template part. */
function captain_plugins_copyright_year( string $content, array $block ): string {
	if ( false === strpos( (string) ( $block['attrs']['className'] ?? '' ), 'cp-copyright' ) ) {
		return $content;
	}
	return str_replace( '{{year}}', esc_html( wp_date( 'Y' ) ), $content );
}
add_filter( 'render_block_core/paragraph', 'captain_plugins_copyright_year', 10, 2 );

/** Let keyboard users focus and scroll wide core tables without changing stored block markup. */
function captain_plugins_accessible_table( string $content ): string {
	if ( false === strpos( $content, 'wp-block-table' ) ) {
		return $content;
	}
	// Name each scroll region after its first column headings so several tables on one page stay distinguishable.
	$columns = array();
	if ( preg_match_all( '#<th\b[^>]*>(.*?)</th>#s', $content, $cells ) ) {
		$columns = array_slice( array_filter( array_map( static fn( $cell ) => trim( wp_strip_all_tags( $cell ) ), $cells[1] ) ), 0, 3 );
	}
	$label = $columns
		/* translators: %s: comma-separated first column headings of a table. */
		? esc_attr( sprintf( __( 'Tabelle mit den Spalten %s; bei Bedarf horizontal scrollen.', 'captain-plugins' ), implode( ', ', $columns ) ) )
		: esc_attr__( 'Tabelle; bei Bedarf horizontal scrollen, um weitere Spalten zu sehen.', 'captain-plugins' );
	return (string) preg_replace_callback(
		'/<figure\b([^>]*)>/i',
		static function ( array $matches ) use ( $label ): string {
			if ( false === strpos( $matches[1], 'wp-block-table' ) || preg_match( '/\btabindex\s*=/', $matches[1] ) ) {
				return $matches[0];
			}
			return '<figure' . $matches[1] . ' tabindex="0" role="region" aria-label="' . $label . '">';
		},
		$content,
		1
	);
}
add_filter( 'render_block_core/table', 'captain_plugins_accessible_table' );

function captain_plugins_register_patterns() {
	$pattern_files = glob( get_theme_file_path( 'patterns/*.php' ) );
	if ( ! $pattern_files ) {
		return;
	}

	foreach ( $pattern_files as $pattern_file ) {
		register_block_pattern( 'captain-plugins/' . basename( $pattern_file, '.php' ), require $pattern_file );
	}
}
add_action( 'init', 'captain_plugins_register_patterns' );
