<?php

/*
 * Shop Title
 */
add_action( 'woocommerce_shop_loop_header', function() { ?>
  <div class="woocommerce-page__title">
      <div class="container">
          <h1><?php esc_html_e('Our Shop', 'codelibry') ?></h1>
      </div>
  </div>
<?php }, 10 );
