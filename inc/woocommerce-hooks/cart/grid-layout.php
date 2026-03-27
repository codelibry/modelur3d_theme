<?php

/*
 * Wrap Cart in GRID Layout
 */
add_action( 'woocommerce_before_cart_table', function() { ?>
  <div class="cart-grid">
    <div class="cart-table-column | box">
<?php });

add_action( 'woocommerce_after_cart_table', function() { ?>
  </div>
<?php });

add_action( 'woocommerce_after_cart', function() { ?>
  </div>
<?php });
