<?php

/*
 * Make "Checkout Form" and "Order details" as grid columns
 */
add_action( 'woocommerce_checkout_before_customer_details', function() { ?>
  <div class="checkout-grid">
<?php });


/*
 * Wrap "Checkout Form" in custom container
 */
add_action( 'woocommerce_checkout_before_customer_details', function() { ?>
  <div class="checkout-form-column | box">
<?php });

add_action( 'woocommerce_checkout_after_customer_details', function() { ?>
  </div>
<?php });


/*
 * Wrap WooCommerce order_review_heading and order_review into one container
 */
add_action( 'woocommerce_checkout_before_order_review_heading', function() { ?>
  <div class="order-details-column">
    <div class="order-details-wrapper | box">
<?php });

add_action( 'woocommerce_checkout_after_order_review', function() { ?>
      </div>
    </div>
  </div>
<?php });
