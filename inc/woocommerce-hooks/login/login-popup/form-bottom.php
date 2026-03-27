<?php

/*
 * Close box around login form and add link to the register page
 */
add_action('woocommerce_login_form', function() { ?>
    <div class="lost-rem">
      <p class="form-row">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
          <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
          <span><?php esc_html_e('Remember me', 'ragnarock'); ?></span>
        </label>
      </p>

      <p class="woocommerce-LostPassword lost_password">
        <?php esc_html_e('Forgot your password?', 'ragnarock') ?>
        <a class="account-switcher reset-switcher" href="#popup-reset-form">
          <?php esc_html_e('Reset', 'ragnarock') ?>
        </a>
      </p>
    </div>

    <div id="cf-turnstile-login" class="cf-turnstile"></div>
  </div>
<?php });


add_action('woocommerce_login_form_end', function() { ?>
  <p class="account-switcher-wrapper">
    <?php esc_html_e('Don’t have an account yet?', 'ragnarock') ?> 
    <a class="account-switcher" href="#popup-register-form"><?php esc_html_e('Sign up', 'ragnarock') ?></a>
  </p>
<?php });
