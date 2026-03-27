<?php

/*
 * Add title for register page
 */
add_action('woocommerce_register_form_start', function() { ?>
  <div class="login-popup__form | flow">
    <h3><?php esc_html_e('Sign up', 'codelibry') ?></h3>
<?php });
