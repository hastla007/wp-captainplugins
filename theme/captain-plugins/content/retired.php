<?php
/**
 * Pages the theme imported earlier but no longer ships, with the recommended 301 target.
 * The importer moves untouched theme-owned copies of these pages back to draft so outdated
 * statements do not stay public. Redirects themselves are configured outside the theme
 * (Yoast SEO Premium, a redirect plugin or the web server), see docs/WEITERLEITUNGEN.md.
 *
 * @package CaptainPlugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	// Claimed License Captain was bundled with Captain Pro; replaced by its own pricing page.
	'license-captain/im-paket' => '/license-captain/preise/',
);
