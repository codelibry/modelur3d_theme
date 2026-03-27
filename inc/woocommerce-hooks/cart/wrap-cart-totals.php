<?php

/*
 * Wrap Cart Totals in wrapper
 */
add_action( 'woocommerce_before_cart_collaterals', function() { ?>
  <div class="cart-totals-column">
    <div class="cart-totals-wrapper | box">
<?php });

add_action( 'woocommerce_after_cart', function() { ?>
    </div>
  </div>
<?php });
