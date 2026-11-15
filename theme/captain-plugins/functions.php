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
