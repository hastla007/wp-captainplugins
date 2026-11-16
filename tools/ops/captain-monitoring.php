<?php
/**
 * Plugin Name: Captain Plugins – Betriebsmeldungen
 * Description: Leitet Gesundheitswarnungen von License Captain per E-Mail weiter und meldet täglich die Zahl fehlgeschlagener und abgebrochener Bestellungen. Nur Kennzahlen, keine Kundendaten.
 * Version: 1.0.0
 * Requires PHP: 8.5
 *
 * Installation: als wp-content/mu-plugins/captain-monitoring.php ablegen (siehe docs/BETRIEB.md, Monitoring).
 * Empfänger: Konstante CAPTAIN_MONITORING_EMAIL in wp-config.php, sonst die Admin-E-Mail der Website.
 *
 * @package CaptainPlugins
 */

defined( 'ABSPATH' ) || exit;

/** Recipient of operational e-mails. */
function captain_monitoring_recipient(): string {
	return defined( 'CAPTAIN_MONITORING_EMAIL' ) ? (string) CAPTAIN_MONITORING_EMAIL : (string) get_option( 'admin_email' );
}

/** Send one operational e-mail with a site prefix in the subject. */
function captain_monitoring_mail( string $subject, string $body ): bool {
	$site = wp_parse_url( home_url(), PHP_URL_HOST );
	return wp_mail( captain_monitoring_recipient(), '[' . $site . '] ' . $subject, $body );
}

// License Captain emits health alerts at the end of its daily run (docs/MONITORING.md of wp-license).
add_action(
	'wplc/health_alert',
	static function ( $metric, $value, $threshold, $url = '' ): void {
		captain_monitoring_mail(
			'License Captain: ' . $metric,
			sprintf( "Kennzahl: %s\nWert: %d (Schwelle %d)\nBearbeiten: %s\n", $metric, (int) $value, (int) $threshold, $url )
		);
	},
	10,
	4
);

// Daily shop summary: failed and cancelled orders of the last 24 hours (counts only).
add_action(
	'init',
	static function (): void {
		if ( function_exists( 'wc_get_orders' ) && ! wp_next_scheduled( 'captain_monitoring_daily' ) ) {
			wp_schedule_event( strtotime( 'tomorrow 06:17' ), 'daily', 'captain_monitoring_daily' );
		}
	}
);

/** Count orders with the given status created in the last 24 hours. */
function captain_monitoring_count_orders( string $status ): int {
	$orders = wc_get_orders(
		array(
			'status'       => $status,
			'date_created' => '>' . ( time() - DAY_IN_SECONDS ),
			'return'       => 'ids',
			'limit'        => 500,
		)
	);
	return count( (array) $orders );
}

add_action(
	'captain_monitoring_daily',
	static function (): void {
		if ( ! function_exists( 'wc_get_orders' ) ) {
			return;
		}
		$failed    = captain_monitoring_count_orders( 'failed' );
		$cancelled = captain_monitoring_count_orders( 'cancelled' );
		$pending   = captain_monitoring_count_orders( 'pending' );
		$threshold = (int) apply_filters( 'captain_monitoring_order_threshold', 1 );
		if ( $failed + $cancelled < $threshold ) {
			return;
		}
		captain_monitoring_mail(
			'Shop: fehlgeschlagene oder abgebrochene Bestellungen',
			sprintf(
				"Letzte 24 Stunden:\n- fehlgeschlagen: %d\n- abgebrochen: %d\n- offen (Zahlung ausstehend): %d\n\nBestellungen: %s\n",
				$failed,
				$cancelled,
				$pending,
				admin_url( 'admin.php?page=wc-orders&status=wc-failed' )
			)
		);
	}
);
