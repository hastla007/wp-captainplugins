<?php
/**
 * Check SEO fields of all generated pages: missing values, title > 60 and description outside
 * 70–160 characters, duplicate titles and focus keyphrases.
 * Usage from the repository root: php tools/qa/seo-fields.php   (exit code 1 on findings)
 */
define( 'ABSPATH', __DIR__ . '/' );
$pages    = require dirname( __DIR__, 2 ) . '/theme/captain-plugins/content/pages.php';
$problems = array();
$seen     = array( 'title' => array(), 'keyphrase' => array() );
foreach ( $pages as $page ) {
	$path        = '' === $page['path'] ? '/' : '/' . $page['path'] . '/';
	$title       = (string) $page['seo_title'];
	$description = (string) $page['meta_description'];
	$keyphrase   = (string) $page['focus_keyphrase'];
	if ( '' === $title ) {
		$problems[] = "$path: kein SEO-Titel";
	} elseif ( mb_strlen( $title ) > 60 ) {
		$problems[] = "$path: SEO-Titel " . mb_strlen( $title ) . ' Zeichen (max. 60)';
	}
	if ( '' === $description ) {
		$problems[] = "$path: keine Meta-Beschreibung";
	} elseif ( mb_strlen( $description ) > 160 || mb_strlen( $description ) < 70 ) {
		$problems[] = "$path: Meta-Beschreibung " . mb_strlen( $description ) . ' Zeichen (70–160)';
	}
	if ( '' === $keyphrase ) {
		$problems[] = "$path: keine Fokus-Keyphrase";
	}
	$seen['title'][ $title ][]                     = $path;
	$seen['keyphrase'][ mb_strtolower( $keyphrase ) ][] = $path;
}
foreach ( array( 'title' => 'SEO-Titel', 'keyphrase' => 'Fokus-Keyphrase' ) as $key => $label ) {
	foreach ( $seen[ $key ] as $value => $paths ) {
		if ( '' !== $value && count( $paths ) > 1 ) {
			$problems[] = "Doppelte $label „{$value}“: " . implode( ', ', $paths );
		}
	}
}
echo count( $pages ) . ' Seiten geprüft, ' . count( $problems ) . " Befunde\n";
foreach ( $problems as $problem ) {
	echo "  $problem\n";
}
exit( $problems ? 1 : 0 );
