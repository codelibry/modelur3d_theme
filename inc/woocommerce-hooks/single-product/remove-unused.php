<?php

/**
 * Remove not used elements
 */
add_filter( 'woocommerce_product_tabs', 'rm_remove_product_reviews_tab', 98 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title',     5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',    10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',     10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',   20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',      40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing',   50 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );