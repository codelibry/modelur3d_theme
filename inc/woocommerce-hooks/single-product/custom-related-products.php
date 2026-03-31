<?php

/*
 * Display Custom "Related Products" section
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', function() {
  global $product;

  get_template_part('template-parts/blocks/product-related', null, [

  ]);
}, 20 );
