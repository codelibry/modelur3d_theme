<?php

/*
 * Wrap product tabs
 */
add_action( 'woocommerce_after_single_product_summary', function() { ?>
  <section class="single-product-tabs | section-top">
    <div class="container">
<?php }, 9);

add_action( 'woocommerce_after_single_product_summary', function() { ?>
    </div>
  </section>
<?php }, 11);
