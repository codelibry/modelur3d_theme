<?php

/*
 * Add title for register page
 */
add_action('woocommerce_register_form_start', function() { ?>
  <div class="login-popup__form | flow">
    <h2><?php esc_html_e('Sign up', 'ragnarock') ?></h2>
<?php });
