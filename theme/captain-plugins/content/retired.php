<?php
/**
 * Pages the theme imported earlier but no longer ships, with the recommended 301 target.
 * The importer moves untouched theme-owned copies of these pages back to draft so outdated
 * statements do not stay public. Permanent redirects belong in Yoast SEO Premium, a redirect plugin
 * or the web server (docs/WEITERLEITUNGEN.md); as a fallback the theme answers a 404 on one of these
 * paths with a 301 to the target.
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
