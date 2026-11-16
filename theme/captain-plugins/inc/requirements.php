<?php
/**
 * Platform minimums for all Captain products (owner decision of 16 November 2026):
 * PHP 8.5, MySQL 9.7 (LTS) or MariaDB 12.3 (LTS). Older versions trigger a notice, never a lock-out.
 *
 * @package CaptainPlugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const CAPTAIN_PLUGINS_MIN_PHP     = '8.5';
const CAPTAIN_PLUGINS_MIN_MYSQL   = '9.7';
const CAPTAIN_PLUGINS_MIN_MARIADB = '12.3';

/**
 * Describe the database server.
 *
 * @return array{type:string,version:string}
 */
function captain_plugins_database_server(): array {
	global $wpdb;
	$info = '';
	if ( isset( $wpdb ) && method_exists( $wpdb, 'db_server_info' ) ) {
		$info = (string) $wpdb->db_server_info();
	}
	if ( '' === $info || ( defined( 'DB_ENGINE' ) && 'sqlite' === DB_ENGINE ) ) {
		return array(
			'type' => 'other',
			'version' => '',
		);
	}
	return captain_plugins_parse_database_server( $info );
}

/**
 * Parse a server_info string such as "9.7.0", "8.0.36-0ubuntu0.22.04.1" or "5.5.5-10.11.6-MariaDB-0+deb12u1".
 *
 * @return array{type:string,version:string}
 */
function captain_plugins_parse_database_server( string $info ): array {
	if ( false !== stripos( $info, 'mariadb' ) && preg_match_all( '/(\d+\.\d+(?:\.\d+)?)/', $info, $all ) ) {
		// MariaDB may prefix a fake "5.5.5-" for old clients; the real version is the one before "-MariaDB".
		$version = preg_match( '/(\d+\.\d+(?:\.\d+)?)-MariaDB/i', $info, $match ) ? $match[1] : end( $all[1] );
		return array(
			'type' => 'mariadb',
			'version' => $version,
		);
	}
	return preg_match( '/^(\d+\.\d+(?:\.\d+)?)/', $info, $match ) ? array(
		'type' => 'mysql',
		'version' => $match[1],
	) : array(
		'type' => 'other',
		'version' => '',
	);
}

/**
 * Collect unmet platform minimums as translated messages.
 *
 * @return list<string>
 */
function captain_plugins_requirement_issues(): array {
	$issues = array();
	if ( version_compare( PHP_VERSION, CAPTAIN_PLUGINS_MIN_PHP, '<' ) ) {
		/* translators: 1: installed PHP version, 2: required PHP version. */
		$issues[] = sprintf( __( 'PHP %1$s ist installiert; Captain Plugins setzen PHP %2$s oder neuer voraus.', 'captain-plugins' ), PHP_VERSION, CAPTAIN_PLUGINS_MIN_PHP );
	}
	$db = captain_plugins_database_server();
	if ( 'mariadb' === $db['type'] && version_compare( $db['version'], CAPTAIN_PLUGINS_MIN_MARIADB, '<' ) ) {
		/* translators: 1: installed MariaDB version, 2: required MariaDB version. */
		$issues[] = sprintf( __( 'MariaDB %1$s ist installiert; empfohlen ist MariaDB %2$s (LTS) oder neuer.', 'captain-plugins' ), $db['version'], CAPTAIN_PLUGINS_MIN_MARIADB );
	} elseif ( 'mysql' === $db['type'] && version_compare( $db['version'], CAPTAIN_PLUGINS_MIN_MYSQL, '<' ) ) {
		/* translators: 1: installed MySQL version, 2: required MySQL version. */
		$issues[] = sprintf( __( 'MySQL %1$s ist installiert; empfohlen ist MySQL %2$s (LTS) oder neuer.', 'captain-plugins' ), $db['version'], CAPTAIN_PLUGINS_MIN_MYSQL );
	}
	return $issues;
}

add_action(
	'admin_notices',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$issues = captain_plugins_requirement_issues();
		if ( empty( $issues ) ) {
			return;
		}
		echo '<div class="notice notice-warning"><p><strong>' . esc_html__( 'Captain Plugins: Server unter den empfohlenen Mindestversionen', 'captain-plugins' ) . '</strong></p><ul style="list-style:disc;padding-left:1.5em">';
		foreach ( $issues as $issue ) {
			echo '<li>' . esc_html( $issue ) . '</li>';
		}
		echo '</ul><p>' . esc_html__( 'Die Website funktioniert weiter. Bitte aktualisieren Sie die Serverumgebung über Ihren Hoster.', 'captain-plugins' ) . '</p></div>';
	}
);
