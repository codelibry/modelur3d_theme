<?php

/*
 * Empty the cart after creating order
 */
add_action( 'woocommerce_checkout_order_created', function() {
  if ( WC()->cart && ! WC()->cart->is_empty() ) {
    WC()->cart->empty_cart();
  }
});
