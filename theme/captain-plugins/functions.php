<?php
/**
 * Captain Plugins theme setup.
 *
 * @package CaptainPlugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_theme_file_path( 'inc/requirements.php' );
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
	add_theme_support(
		'custom-logo',
		array(
			'height' => 64,
			'width' => 220,
			'flex-height' => true,
			'flex-width' => true,
		)
	);
	add_theme_support( 'woocommerce' );

	register_block_pattern_category(
		'captain-plugins',
		array(
			'label' => __( 'Captain Plugins', 'captain-plugins' ),
		)
	);
}
add_action( 'after_setup_theme', 'captain_plugins_setup' );

/**
 * Disable the core emoji loader: it adds inline JavaScript, a sessionStorage entry and may fetch
 * images from the WordPress CDN (s.w.org). Modern browsers render emoji natively.
 */
function captain_plugins_disable_emoji(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'captain_plugins_disable_emoji' );

/** Brand favicon until a site icon is set under Settings → General (that one always wins). */
function captain_plugins_fallback_favicon(): void {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( get_theme_file_uri( 'assets/images/favicon.svg' ) ) . '" type="image/svg+xml">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( get_theme_file_uri( 'assets/images/apple-touch-icon.png' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'captain_plugins_fallback_favicon', 99 );

function captain_plugins_enqueue_styles() {
	wp_enqueue_style(
		'captain-plugins-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'captain_plugins_enqueue_styles' );

/** Classic WooCommerce forms: expose field errors to assistive technology (checkout and account only). */
function captain_plugins_enqueue_form_errors() {
	if ( ! function_exists( 'is_checkout' ) || ! ( is_checkout() || is_account_page() ) ) {
		return;
	}
	wp_enqueue_script(
		'captain-plugins-form-errors',
		get_theme_file_uri( 'assets/js/form-errors.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'captain_plugins_enqueue_form_errors' );

/**
 * WooCommerce loads its classic shop CSS and jQuery scripts on every page. Content pages without shop
 * blocks do not need them; dropping them saves render-blocking requests. Order attribution stays as
 * configured in WooCommerce. Disable with add_filter( 'captain_plugins_trim_shop_assets', '__return_false' ).
 */
function captain_plugins_trim_shop_assets() {
	if ( ! function_exists( 'is_woocommerce' ) || ! apply_filters( 'captain_plugins_trim_shop_assets', true ) ) {
		return;
	}
	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		return;
	}
	$post = get_queried_object();
	if ( $post instanceof WP_Post && ( str_contains( $post->post_content, '<!-- wp:woocommerce/' ) || has_shortcode( $post->post_content, 'products' ) || has_shortcode( $post->post_content, 'add_to_cart' ) ) ) {
		return;
	}
	foreach ( array( 'woocommerce-general', 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-blocktheme' ) as $style ) {
		wp_dequeue_style( $style );
	}
	foreach ( array( 'woocommerce', 'wc-add-to-cart', 'wc-cart-fragments' ) as $script ) {
		wp_dequeue_script( $script );
	}
}
add_action( 'wp_enqueue_scripts', 'captain_plugins_trim_shop_assets', 99 );

/** Build the lightweight page breadcrumb; Yoast remains responsible for structured data. */
function captain_plugins_breadcrumb_markup(): string {
	$shop_markup = captain_plugins_shop_breadcrumb_items();
	if ( array() !== $shop_markup ) {
		return captain_plugins_breadcrumb_nav( $shop_markup );
	}
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
	return captain_plugins_breadcrumb_nav( $items );
}

/** Wrap breadcrumb list items in the shared navigation markup. */
function captain_plugins_breadcrumb_nav( array $items ): string {
	return '<nav class="cp-breadcrumb" aria-label="' . esc_attr__( 'Brotkrumennavigation', 'captain-plugins' ) . '"><ol>' . implode( '', $items ) . '</ol></nav>';
}

/**
 * Breadcrumb items for WooCommerce catalog, taxonomy and product views.
 *
 * @return list<string>
 */
function captain_plugins_shop_breadcrumb_items(): array {
	if ( ! function_exists( 'is_shop' ) || ! ( is_shop() || is_product_taxonomy() || is_product() ) ) {
		return array();
	}
	$shop_id    = (int) wc_get_page_id( 'shop' );
	$shop_title = $shop_id > 0 ? get_the_title( $shop_id ) : __( 'Shop', 'captain-plugins' );
	$items      = array( '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Startseite', 'captain-plugins' ) . '</a></li>' );
	if ( is_shop() ) {
		$items[] = '<li aria-current="page"><span>' . esc_html( $shop_title ) . '</span></li>';
		return $items;
	}
	$items[] = '<li><a href="' . esc_url( (string) wc_get_page_permalink( 'shop' ) ) . '">' . esc_html( $shop_title ) . '</a></li>';
	$current = is_product() ? get_the_title( get_queried_object_id() ) : single_term_title( '', false );
	$items[] = '<li aria-current="page"><span>' . esc_html( (string) $current ) . '</span></li>';
	return $items;
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
add_filter( 'render_block_core/query-title', 'captain_plugins_breadcrumb_before_title', 10, 2 );
add_filter( 'render_block_core/heading', 'captain_plugins_breadcrumb_before_title', 10, 2 );

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

/** Point template buttons with the account token at the WooCommerce account page (support page without a shop). */
function captain_plugins_account_url_token( string $content ): string {
	if ( false === strpos( $content, '{{account_url}}' ) ) {
		return $content;
	}
	$url = function_exists( 'wc_get_page_permalink' ) ? (string) wc_get_page_permalink( 'myaccount' ) : '';
	return str_replace( '{{account_url}}', esc_url( '' !== $url ? $url : home_url( '/support/' ) ), $content );
}
add_filter( 'render_block_core/button', 'captain_plugins_account_url_token' );

/** Branded placeholder for products without an image (Captain Pro licenses are virtual products). */
function captain_plugins_product_placeholder( string $src ): string {
	unset( $src );
	return get_theme_file_uri( 'assets/images/product-placeholder.svg' );
}
add_filter( 'woocommerce_placeholder_img_src', 'captain_plugins_product_placeholder' );

/** WooCommerce prefers its placeholder attachment; swap that image for the theme placeholder as well. */
function captain_plugins_product_placeholder_html( string $html, $size = '', $dimensions = array() ): string {
	unset( $size );
	// Keep WooCommerce's alt text: the image is often the only content of a product link.
	$alt    = preg_match( '/\salt="([^"]*)"/', $html, $match ) ? html_entity_decode( $match[1], ENT_QUOTES ) : '';
	$width  = (int) ( $dimensions['width'] ?? 600 );
	$height = (int) ( $dimensions['height'] ?? 600 );
	return sprintf(
		'<img src="%1$s" alt="%4$s" width="%2$d" height="%3$d" class="woocommerce-placeholder wp-post-image" decoding="async" loading="lazy" />',
		esc_url( captain_plugins_product_placeholder( '' ) ),
		$width > 0 ? $width : 600,
		$height > 0 ? $height : 600,
		esc_attr( $alt )
	);
}
add_filter( 'woocommerce_placeholder_img', 'captain_plugins_product_placeholder_html', 10, 3 );
