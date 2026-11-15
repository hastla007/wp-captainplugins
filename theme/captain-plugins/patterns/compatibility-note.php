<?php
/**
 * Title: Voraussetzungen und Kompatibilität
 * Slug: captain-plugins/compatibility-note
 * Categories: captain-plugins, text
 * Description: Hinweisbereich mit Link zur verbindlichen Kompatibilitätsmatrix.
 * Viewport Width: 760
 */
return array(
	'title'       => __( 'Voraussetzungen und Kompatibilität', 'captain-plugins' ),
	'categories'  => array( 'captain-plugins', 'text' ),
	'description' => __( 'Hinweisbereich mit Link zur aktuellen Kompatibilitätsmatrix.', 'captain-plugins' ),
	'content'     => '<!-- wp:group {"className":"cp-compatibility-note","layout":{"type":"constrained"}} --><div class="wp-block-group cp-compatibility-note"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Voraussetzungen und Kompatibilität</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Die Anforderungen unterscheiden sich je nach Produkt und Version. Prüfen Sie vor der Installation die aktuelle Kompatibilitätsmatrix mit den bestätigten WordPress-, PHP- und gegebenenfalls WooCommerce-Versionen.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><a href="/kompatibilitaet/">Kompatibilität und Integrationen ansehen</a></p><!-- /wp:paragraph --></div><!-- /wp:group -->',
);
