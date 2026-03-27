<?php

/*
 * Change add_to_cart button text
 */
add_filter( 'woocommerce_product_add_to_cart_text', function() {
  return __('Buy', 'codelibry');
});
