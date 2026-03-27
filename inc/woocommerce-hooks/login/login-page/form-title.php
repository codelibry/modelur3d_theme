<?php

/**
 * Add Box around login form
 */

add_action('woocommerce_before_customer_login_form', function() {
    echo '<div class="page-auth box">';
});

/*
 * Add Title on login page
 */
add_action('woocommerce_login_form_start', function() { ?>
  <div class="login-popup__form | flow">
    <h3><?php esc_html_e('Sign In', 'codelibry') ?></h3>
<?php });
