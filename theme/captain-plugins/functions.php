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

/** Add a lightweight page breadcrumb; Yoast remains responsible for structured data. */
function captain_plugins_page_breadcrumb( string $content ): string {
	if ( is_admin() || is_feed() || ! is_page() || is_front_page() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$page = get_post();
	if ( ! $page instanceof WP_Post ) {
		return $content;
	}
	$items = array();
	$items[] = '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Startseite', 'captain-plugins' ) . '</a></li>';
	foreach ( array_reverse( get_post_ancestors( $page ) ) as $ancestor_id ) {
		$ancestor = get_post( $ancestor_id );
		if ( $ancestor instanceof WP_Post ) {
			$items[] = '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
		}
	}
	$items[] = '<li aria-current="page"><span>' . esc_html( get_the_title( $page ) ) . '</span></li>';
	$breadcrumb = '<nav class="cp-breadcrumb" aria-label="' . esc_attr__( 'Brotkrumennavigation', 'captain-plugins' ) . '"><ol>' . implode( '', $items ) . '</ol></nav>';
	return $breadcrumb . $content;
}
add_filter( 'the_content', 'captain_plugins_page_breadcrumb', 8 );

/** Let keyboard users focus and scroll wide core tables without changing stored block markup. */
function captain_plugins_accessible_table( string $content ): string {
	if ( false === strpos( $content, 'wp-block-table' ) ) {
		return $content;
	}
	$label = esc_attr__( 'Tabelle; bei Bedarf horizontal scrollen, um weitere Spalten zu sehen.', 'captain-plugins' );
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
