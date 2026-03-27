<?php

/*
 * Add confirm password field to WooCommerce registration form.
 */
add_action( 'woocommerce_register_form', function() { ?>
    <p class="form-row form-row-wide">
      <label for="reg_password2"><?php esc_html_e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="password" class="input-text" name="password2" id="reg_password2" autocomplete="new-password" required/>
    </p>
  </div>
<?php });


/*
 * Validate confirm password field on registration.
 */
add_filter( 'woocommerce_registration_errors', function( $errors, $sanitized_user_login, $user_email ) {
  if ( isset( $_POST['password'] ) && isset( $_POST['password2'] ) && strcmp( $_POST['password'], $_POST['password2'] ) !== 0 ) {
    $errors->add( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
  }

  return $errors;
}, 10, 3 );
