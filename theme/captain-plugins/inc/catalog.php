<?php
/** Create draft WooCommerce products and map their Captain Pro license plans. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function captain_plugins_setup_plan_rows(): array {
	$products = array(
		'voucher-captain-pro'   => array( 'name' => 'Voucher Captain Pro', 'support' => 'standard', 'prices' => array( 'single' => 129, 'business' => 229, 'agency' => 399 ) ),
		'pass-captain-pro'      => array( 'name' => 'Pass Captain Pro', 'support' => 'standard', 'prices' => array( 'single' => 169, 'business' => 299, 'agency' => 549 ) ),
		'affiliate-captain-pro' => array( 'name' => 'Affiliate Captain Pro', 'support' => 'standard', 'prices' => array( 'single' => 229, 'business' => 399, 'agency' => 699 ) ),
	);
	$limits = array( 'single' => 1, 'business' => 5, 'agency' => 25 );
	$rows   = array();
	foreach ( $products as $product_key => $product ) {
		foreach ( $product['prices'] as $plan_key => $price ) {
			$rows[] = array(
				'product_key' => $product_key,
				'product_name' => $product['name'],
				'plan_key' => $plan_key,
				'price' => (string) $price,
				'limit' => $limits[ $plan_key ],
				'support' => 'agency' === $plan_key ? 'priority' : $product['support'],
				'sku' => 'cp-' . str_replace( '-pro', '', $product_key ) . '-' . $plan_key,
				'title' => sprintf( '%1$s – %2$s (%3$d %4$s, jährlich)', $product['name'], ucfirst( $plan_key ), $limits[ $plan_key ], 1 === $limits[ $plan_key ] ? 'Website' : 'Websites' ),
			);
		}
	}
	return $rows;
}

function captain_plugins_setup_license_mapping( WC_Product $product, array $row ): bool {
	if ( ! class_exists( '\\WPLC\\Catalog\\Catalog' ) || ! method_exists( '\\WPLC\\Catalog\\Catalog', 'save_mapping' ) ) {
		return false;
	}
	$group       = substr( (string) $row['product_key'], 0, strpos( (string) $row['product_key'], '-' ) );
	$entitlements = array();
	if ( class_exists( '\\WPLC\\Catalog\\EntitlementCatalog' ) && method_exists( '\\WPLC\\Catalog\\EntitlementCatalog', 'all' ) ) {
		$catalog = \WPLC\Catalog\EntitlementCatalog::all();
		foreach ( (array) ( $catalog[ $group ] ?? array() ) as $feature ) {
			if ( is_array( $feature ) && ! empty( $feature['key'] ) ) {
				$entitlements[ (string) $feature['key'] ] = true;
			}
		}
	}
	$mapping = array(
		'product_key' => (string) $row['product_key'],
		'plan_key' => (string) $row['plan_key'],
		'billing_interval' => 'year',
		'live_site_limit' => (int) $row['limit'],
		'support_level' => (string) $row['support'],
		'entitlements' => $entitlements,
		'display_name' => (string) $row['product_name'],
	);
	if ( ! \WPLC\Catalog\Catalog::save_mapping( (int) $product->get_id(), 0, $mapping ) ) {
		return false;
	}
	$product->update_meta_data( '_wplc_is_license_product', 'yes' );
	$product->update_meta_data( '_wplc_product_key', $mapping['product_key'] );
	$product->update_meta_data( '_wplc_plan_key', $mapping['plan_key'] );
	$product->update_meta_data( '_wplc_billing_interval', 'year' );
	$product->update_meta_data( '_wplc_live_site_limit', (int) $row['limit'] );
	$product->update_meta_data( '_wplc_support_level', (string) $row['support'] );
	$product->update_meta_data( '_wplc_entitlements_json', wp_json_encode( $entitlements ) );
	$product->save();
	return true;
}

/**
 * Create nine virtual WooCommerce product drafts with corresponding annual license plans.
 * Existing SKUs are never repurposed or repriced.
 *
 * @return array{created:int,mapped:int,existing:int,skipped:int,errors:int,messages:list<string>}
 */
function captain_plugins_setup_create_products(): array {
	$result = array( 'created' => 0, 'mapped' => 0, 'existing' => 0, 'skipped' => 0, 'errors' => 0, 'messages' => array() );
	if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'wc_get_product' ) || ! class_exists( '\\WPLC\\Catalog\\Catalog' ) ) {
		$result['errors']++;
		$result['messages'][] = __( 'Für die Produktanlage müssen WooCommerce und License Captain aktiv sein.', 'captain-plugins' );
		return $result;
	}
	if ( ! current_user_can( 'manage_woocommerce' ) ) {
		$result['errors']++;
		$result['messages'][] = __( 'Dein Benutzerkonto darf keine WooCommerce-Produkte verwalten.', 'captain-plugins' );
		return $result;
	}
	if ( 'EUR' !== strtoupper( (string) get_option( 'woocommerce_currency', 'USD' ) ) ) {
		$result['errors']++;
		$result['messages'][] = __( 'Die Konzeptpreise sind in Euro. Stelle zuerst die WooCommerce-Währung auf EUR, bevor die Preisentwürfe angelegt werden.', 'captain-plugins' );
		return $result;
	}

	foreach ( captain_plugins_setup_plan_rows() as $row ) {
		$product_id = function_exists( 'wc_get_product_id_by_sku' ) ? absint( wc_get_product_id_by_sku( $row['sku'] ) ) : 0;
		$product    = $product_id ? wc_get_product( $product_id ) : false;
		if ( $product && 'captain-plugins-theme-v1' !== (string) $product->get_meta( '_cp_theme_product', true ) ) {
			++$result['skipped'];
			$result['messages'][] = sprintf( __( 'SKU %s existiert bereits und wurde nicht verändert.', 'captain-plugins' ), $row['sku'] );
			continue;
		}
		if ( ! $product ) {
			$product = new WC_Product_Simple();
			$product->set_name( (string) $row['title'] );
			$product->set_status( 'draft' );
			$product->set_sku( (string) $row['sku'] );
			$product->set_regular_price( (string) $row['price'] );
			$product->set_virtual( true );
			$product->set_downloadable( false );
			$product->set_catalog_visibility( 'hidden' );
			/* translators: 1: product name, 2: number of live websites, 3: support level. */
			$product->set_short_description( sprintf( _n( 'Jahreslizenz für %1$s. %2$d Live-Website; %3$s-Support. License Captain verwaltet Lizenz und Updates.', 'Jahreslizenz für %1$s. %2$d Live-Websites; %3$s-Support. License Captain verwaltet Lizenz und Updates.', (int) $row['limit'], 'captain-plugins' ), $row['product_name'], $row['limit'], 'priority' === $row['support'] ? __( 'Priority', 'captain-plugins' ) : __( 'Standard', 'captain-plugins' ) ) );
			$product_id = $product->save();
			if ( ! $product_id ) {
				++$result['errors'];
				$result['messages'][] = sprintf( __( 'WooCommerce konnte „%s“ nicht speichern.', 'captain-plugins' ), $row['title'] );
				continue;
			}
			$product->update_meta_data( '_cp_theme_product', 'captain-plugins-theme-v1' );
			$product->save();
			++$result['created'];
		}

		$existing = method_exists( '\\WPLC\\Catalog\\Catalog', 'find_exact_mapping' ) ? \WPLC\Catalog\Catalog::find_exact_mapping( (int) $product->get_id(), 0 ) : null;
		if ( $existing ) {
			if ( is_array( $existing ) && (string) ( $existing['product_key'] ?? '' ) === (string) $row['product_key'] && (string) ( $existing['plan_key'] ?? '' ) === (string) $row['plan_key'] ) {
				++$result['existing'];
			} else {
				++$result['skipped'];
				$result['messages'][] = sprintf( __( 'Der Lizenzplan für „%s“ ist bereits anders zugeordnet und wurde nicht geändert.', 'captain-plugins' ), $row['title'] );
			}
			continue;
		}
		if ( captain_plugins_setup_license_mapping( $product, $row ) ) {
			++$result['mapped'];
		} else {
			++$result['errors'];
			$result['messages'][] = sprintf( __( '„%s“ ist als Entwurf angelegt, aber License Captain hat den Jahresplan nicht übernehmen können.', 'captain-plugins' ), $row['title'] );
		}
	}
	return $result;
}
