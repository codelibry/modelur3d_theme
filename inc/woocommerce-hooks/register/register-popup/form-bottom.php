<?php

/**
 * Close last box around register form and add link to the login page
 */

add_action('woocommerce_register_form_end', function() { ?>
    <p class="account-switcher-wrapper">
      <?php esc_html_e('Already have an account?', 'ragnarock') ?> 
      <a class="account-switcher" href="#popup-login-form"><?php esc_html_e('Sign in', 'ragnarock') ?></a>
    </p>
  </div>
<?php });
