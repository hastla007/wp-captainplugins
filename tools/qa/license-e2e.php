<?php
/**
 * License Captain end-to-end check on staging: a Pro add-on activates a license against this shop.
 *
 * Usage (on the staging server, WordPress with WooCommerce and License Captain active):
 *   php tools/qa/license-e2e.php /path/to/wp-load.php <license-key> [product-key]
 *
 * Steps: activation with the client library bundled in License Captain (signed answer verified with the
 * shop's public key), entitlement check, a second site must be refused once the site limit is used,
 * deactivation. Purchase and renewal run through the shop itself (see docs/BETRIEB.md, Kaufstrecke).
 * Over plain http (local staging) the client is told to accept it; production must use https.
 *
 * @package CaptainPlugins
 */

if ( PHP_SAPI !== 'cli' || $argc < 3 ) {
	fwrite( STDERR, "Aufruf: php license-e2e.php /pfad/zu/wp-load.php <Lizenzschlüssel> [produkt-key]\n" );
	exit( 2 );
}
require $argv[1];

$key     = trim( $argv[2] );
$product = $argv[3] ?? 'pass-captain-pro';
$failed  = 0;
$step    = static function ( string $name, bool $ok, string $detail = '' ) use ( &$failed ): void {
	echo ( $ok ? 'OK     ' : 'FEHLER ' ) . $name . ( $ok || '' === $detail ? '' : ' – ' . $detail ) . "\n";
	$failed += $ok ? 0 : 1;
};

if ( ! class_exists( '\WPLC\Client\LicenseClient' ) || ! class_exists( '\WPLC\Security\ResponseSigner' ) ) {
	$step( 'License Captain aktiv', false, 'Klassen nicht gefunden' );
	exit( 1 );
}
$secret = \WPLC\Security\ResponseSigner::secret_key();
$public = $secret ? \WPLC\Security\ResponseSigner::public_key_of( $secret ) : '';
$step( 'Signaturschlüssel des Servers vorhanden', '' !== $public );

$server = home_url();
$args   = array(
	'public_keys'        => array( $public ),
	'allow_insecure'     => str_starts_with( $server, 'http://' ),
	'allow_local_server' => true,
	'timeout'            => 30,
);
$client = new \WPLC\Client\LicenseClient( $server, $product, '1.0.0', 'cp_license_e2e', $args );

$result = $client->activate( $key );
$step( 'Aktivierung', ! is_wp_error( $result ) && $client->is_activated(), is_wp_error( $result ) ? $result->get_error_code() : '' );
if ( ! is_wp_error( $result ) ) {
	$features = array_filter( (array) ( $result['entitlements'] ?? array() ), static fn( $value, $name ) => true === $value && str_contains( (string) $name, '.' ) && ! str_starts_with( (string) $name, 'sites.' ) && ! str_starts_with( (string) $name, 'support.' ), ARRAY_FILTER_USE_BOTH );
	$step( 'Pro-Funktionen freigegeben (' . count( $features ) . ')', count( $features ) > 0, 'keine Funktion im Plan – License-Captain-Katalog prüfen' );
}

$check = $client->check_entitlements();
$step( 'Funktionsprüfung mit signierter Antwort', ! is_wp_error( $check ), is_wp_error( $check ) ? $check->get_error_code() : '' );

$limit = is_wp_error( $result ) ? 0 : (int) ( $result['entitlements']['sites.live_limit'] ?? 0 );
if ( 1 === $limit ) {
	add_filter( 'pre_option_home', static fn() => 'https://zweite-website.example' );
	$second = new \WPLC\Client\LicenseClient( $server, $product, '1.0.0', 'cp_license_e2e_2', $args );
	$other  = $second->activate( $key );
	$step( 'Zweite Website wird abgewiesen (Limit 1)', is_wp_error( $other ) && 'site_limit' === $other->get_error_code(), is_wp_error( $other ) ? $other->get_error_code() : 'wurde aktiviert' );
	remove_all_filters( 'pre_option_home' );
	if ( ! is_wp_error( $other ) ) {
		$second->deactivate();
	}
}

$released = $client->deactivate();
$step( 'Deaktivierung', ! is_wp_error( $released ) && ! $client->is_activated(), is_wp_error( $released ) ? $released->get_error_code() : '' );

echo $failed ? "$failed Schritte fehlgeschlagen.\n" : "Alle Schritte bestanden.\n";
exit( $failed ? 1 : 0 );
