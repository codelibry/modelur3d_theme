<?php

/*
 * Add checkbox to registration form
 */
add_action( 'woocommerce_register_form', function() {

  // Remove default checkbox
  remove_action( 'woocommerce_register_form', 'wc_privacy_policy_checkbox', 20 );

  // Get WordPress Privacy Policy page
  $privacy_page_id = get_option( 'wp_page_for_privacy_policy' );
  $privacy_url = $privacy_page_id ? get_permalink( $privacy_page_id ) : '#';

  // Get WooCommerce Terms & Conditions page
  $terms_page_id = wc_get_page_id( 'terms' );
  $terms_url = $terms_page_id > 0 ? get_permalink( $terms_page_id ) : '#';

  // Add custom checkbox
  ?>
  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
          <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                 name="privacy_policy" type="checkbox" id="privacy_policy" value="1" required />
          <span>
              <?php 
              echo wp_kses_post( sprintf(
                  'I agree with the <a href="%s" target="_blank">Privacy Policy</a> and <a href="%s" target="_blank">Terms of Use</a>',
                  esc_url( $privacy_url ),
                  esc_url( $terms_url )
              ) ); 
              ?>
          </span>
      </label>
  </p>
  <div id="cf-turnstile-register" class="cf-turnstile"></div>
<?php }, 20 );


/*
 * Optional: Validate the checkbox on registration
 */
add_filter( 'woocommerce_registration_errors', function( $errors, $username, $email ) {
  if ( empty( $_POST['privacy_policy'] ) ) {
    $errors->add( 'privacy_policy_error', __( 'You must accept the privacy policy and terms.', 'ragnarock' ) );
  }

  return $errors;
}, 10, 3 );
