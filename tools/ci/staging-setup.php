<?php
/**
 * Prepare a CI staging site (run with: wp eval-file tools/ci/staging-setup.php <key-file>).
 * Expects WordPress, WooCommerce, Yoast SEO, License Captain and the theme to be active.
 * Imports the website texts, creates the Captain Pro products with the setup assistant, places a paid
 * test order for a customer and writes the issued license key to <key-file> for license-e2e.php.
 *
 * @package CaptainPlugins
 */

$cp_key_file = $args[0] ?? '/tmp/license-key.txt';
wp_set_current_user( 1 );

WC_Install::install();
foreach ( array(
	'woocommerce_default_country' => 'AT',
	'woocommerce_currency'        => 'EUR',
	'woocommerce_coming_soon'     => 'no',
) as $cp_option => $cp_value ) {
	update_option( $cp_option, $cp_value );
}
$cp_bacs            = (array) get_option( 'woocommerce_bacs_settings', array() );
$cp_bacs['enabled'] = 'yes';
update_option( 'woocommerce_bacs_settings', $cp_bacs );

$cp_sync = captain_plugins_content_sync( array( 'core', 'products', 'guides' ), true );
WP_CLI::log( 'Seiten importiert: ' . wp_json_encode( $cp_sync ) );
foreach ( get_posts( array( 'post_type' => 'page', 'post_status' => 'draft', 'numberposts' => -1 ) ) as $cp_page ) {
	wp_update_post( array( 'ID' => $cp_page->ID, 'post_status' => 'publish' ) );
}
$cp_front = get_page_by_path( 'startseite' );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $cp_front ? $cp_front->ID : 0 );

$cp_products = captain_plugins_setup_create_products();
WP_CLI::log( sprintf( 'Pro-Produkte: %d angelegt, %d zugeordnet, %d Fehler', $cp_products['created'], $cp_products['mapped'], $cp_products['errors'] ) );
foreach ( $cp_products['messages'] as $cp_message ) {
	WP_CLI::log( '  ' . $cp_message );
}
if ( $cp_products['errors'] ) {
	WP_CLI::error( 'Setup-Assistent meldet Fehler.' );
}
foreach ( wc_get_products( array( 'status' => 'draft', 'limit' => -1 ) ) as $cp_product ) {
	$cp_product->set_status( 'publish' );
	$cp_product->set_catalog_visibility( 'visible' );
	$cp_product->save();
}

$cp_customer = get_user_by( 'login', 'kunde' );
$cp_customer = $cp_customer ? $cp_customer->ID : wc_create_new_customer( 'kunde@example.com', 'kunde', 'Test-Pass-123!' );
$cp_item     = wc_get_products( array( 'sku' => 'cp-pass-captain-single', 'limit' => 1 ) );
$cp_order    = wc_create_order( array( 'customer_id' => $cp_customer ) );
$cp_order->add_product( $cp_item[0], 1 );
$cp_order->set_address( array( 'first_name' => 'Kim', 'last_name' => 'Kunde', 'email' => 'kunde@example.com', 'country' => 'AT', 'city' => 'Wien', 'postcode' => '1010', 'address_1' => 'Ring 1' ), 'billing' );
$cp_order->set_payment_method( 'bacs' );
$cp_order->calculate_totals();
$cp_order->save();
$cp_order->payment_complete( 'CI-TEST' );

global $wpdb;
$cp_license = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wplc_licenses WHERE customer_id = %d ORDER BY id DESC LIMIT 1", $cp_customer ), ARRAY_A );
if ( ! $cp_license ) {
	WP_CLI::error( 'License Captain hat keine Lizenz ausgestellt.' );
}
$cp_key = \WPLC\License\LicenseKey::for_uuid( (string) $cp_license['license_uuid'], (string) $cp_license['license_key_secret_id'] );
file_put_contents( $cp_key_file, $cp_key );
flush_rewrite_rules( true );
WP_CLI::success( 'Lizenz #' . $cp_license['id'] . ' (' . $cp_license['status'] . ') ausgestellt, Schlüssel in ' . $cp_key_file );
