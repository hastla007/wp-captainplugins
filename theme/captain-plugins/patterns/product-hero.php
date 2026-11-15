<?php
/**
 * Title: Produktseite – Hero
 * Slug: captain-plugins/product-hero
 * Categories: captain-plugins, banner
 * Description: Einstiegsbereich für eine Produktseite. Produktname, Nutzen und CTA anpassen.
 * Viewport Width: 1160
 */
return array(
	'title'       => __( 'Produktseite – Hero', 'captain-plugins' ),
	'categories'  => array( 'captain-plugins', 'banner' ),
	'description' => __( 'Einstiegsbereich für eine Produktseite. Produktname, Nutzen und CTA anpassen.', 'captain-plugins' ),
	'content'     => '<!-- wp:group {"align":"full","className":"cp-hero","layout":{"type":"constrained"}} --><div class="wp-block-group alignfull cp-hero"><!-- wp:group {"className":"cp-hero__inner","layout":{"type":"constrained"}} --><div class="wp-block-group cp-hero__inner"><!-- wp:paragraph {"className":"cp-eyebrow"} --><p class="cp-eyebrow">[Produktkategorie oder Zielgruppe]</p><!-- /wp:paragraph --><!-- wp:heading {"level":1,"fontSize":"x-large"} --><h1 class="wp-block-heading has-x-large-font-size">[Produktname]: [wichtigstes Ergebnis]</h1><!-- /wp:heading --><!-- wp:paragraph {"className":"cp-hero__lead"} --><p class="cp-hero__lead">[In zwei Sätzen erklären, welchen Geschäftsprozess das Produkt unterstützt und für wen es gedacht ist.]</p><!-- /wp:paragraph --><!-- wp:buttons {"className":"cp-actions"} --><div class="wp-block-buttons cp-actions"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/preise/">[Primäre Aktion einsetzen]</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/dokumentation/">Dokumentation ansehen</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group --></div><!-- /wp:group -->',
);
