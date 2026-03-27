<!-- Login Form -->
<dialog class="popup__wrapper" id="popup-login-form">
  <div class="popup | box">
    <button class="popup__close">
      <?php echo get_inline_svg('close-icon') ?>
      <span class="visually-hidden"><?php esc_html_e('Close Popup', 'ragnarock') ?></span>
    </button>

    <div class="popup-login">
      <div class="popup-login__login">
        <?php echo do_shortcode('[wc_login_form_rs]'); ?>
      </div>
    </div>
  </div>
</dialog>

<!-- Reset Password Message -->

<?php
$reset_error = ! empty( $_GET['reset-error'] ) ? urldecode( $_GET['reset-error'] ) : '';
?>

<!-- Reset Password Form -->
<dialog class="popup__wrapper" id="popup-reset-form">
  <div class="popup | box">
    <button class="popup__close">
      <?php echo get_inline_svg('close-icon') ?>
      <span class="visually-hidden"><?php esc_html_e('Close Popup', 'ragnarock') ?></span>
    </button>

    <div class="popup-login">
      <div class="popup-login__reset-password">
        <h3><?php esc_html_e('Lost your password?', 'ragnarock') ?></h3>
        <?php if ( $reset_error ) : ?>
          <div class="auth-error woocommerce-error">
            <h4 class="auth-error__title"><?php esc_html_e( 'Reset failed', 'ragnarock' ) ?></h4>
            <p class="auth-error__text"><?php echo esc_html( $reset_error ) ?></p>
          </div>
        <?php endif; ?>
        <?php wc_get_template( 'myaccount/form-lost-password.php' ); ?>
        <p class="account-switcher-wrapper">
          <?php esc_html_e('Back to') ?>
          <a class="account-switcher" href="#popup-login-form">
            <?php esc_html_e(' Sign In', 'ragnarock') ?>
          </a>
        </p>
      </div>
    </div>
  </div>
</dialog>


<!-- Register Form -->
<dialog class="popup__wrapper" id="popup-register-form">
  <div class="popup | box">
    <button class="popup__close">
      <?php echo get_inline_svg('close-icon') ?>
      <span class="visually-hidden"><?php esc_html_e('Close Popup', 'ragnarock') ?></span>
    </button>

    <div class="popup-login">
      <div class="popup-login__register">
        <?php echo do_shortcode('[wc_reg_form_rs]'); ?>
      </div>
    </div>
  </div>
</dialog>
