<?php
/**
 * Router for PHP's built-in web server in CI: serve existing files, send everything else to WordPress.
 * Start from the WordPress root: php -S 127.0.0.1:8080 /path/to/tools/ci/router.php
 */
$cp_path = (string) parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$cp_file = getcwd() . $cp_path;
if ( '/' !== $cp_path && is_file( $cp_file ) ) {
	return false;
}
if ( is_dir( $cp_file ) && is_file( rtrim( $cp_file, '/' ) . '/index.php' ) ) {
	$_SERVER['SCRIPT_NAME'] = rtrim( $cp_path, '/' ) . '/index.php';
	require rtrim( $cp_file, '/' ) . '/index.php';
	return;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
require getcwd() . '/index.php';
