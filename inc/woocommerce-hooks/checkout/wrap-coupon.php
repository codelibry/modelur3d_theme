<?php

/*
 * Wrap Coupon widget into separate container called ".coupon"
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_action( 'woocommerce_before_checkout_form', function() { ?>
  <div class="coupon-widget">
<?php }, 15 );

add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 20 );

add_action( 'woocommerce_before_checkout_form', function() { ?>
  </div>
<?php }, 30 );
