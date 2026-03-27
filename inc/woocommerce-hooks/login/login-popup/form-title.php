<?php

/*
 * Add Title on login popup
 */
add_action('woocommerce_login_form_start', function() { ?>
  <div class="login-popup__form | flow">
    <h2><?php esc_html_e('Welcome', 'ragnarock') ?></h2>
<?php });
