<?php
/**
 * Reorder Single Product Summary Elements
 */
add_action( 'init', function() {
    // 5: Product title
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

    // 10: Full description 
    add_action( 'woocommerce_single_product_summary', 'custom_single_product_full_description', 10 );

    // 19: Open price + cart wrapper
    add_action( 'woocommerce_single_product_summary', 'custom_price_cart_wrapper_open', 19 );

    // 20: Price
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );

    // 30: Add to Cart
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

    // 31: Close price + cart wrapper
    add_action( 'woocommerce_single_product_summary', 'custom_price_cart_wrapper_close', 31 );

    // 40: Custom product meta block
    add_action( 'woocommerce_single_product_summary', 'custom_product_meta_block', 40 );
});

