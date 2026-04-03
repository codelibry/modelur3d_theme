<?php
/**
 * My Account Dashboard - Custom Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$current_user = wp_get_current_user();
$customer = new WC_Customer( get_current_user_id() );

/*
 * Save contact information
 */
$contact_saved = false;
$contact_saved_error = '';

if ( 
  isset( $_POST['save_contact_info'] ) && 
  isset( $_POST['contact_info_nonce'] ) && 
  wp_verify_nonce( $_POST['contact_info_nonce'], 'save_contact_info' )
) {
	$first_name = sanitize_text_field( $_POST['account_first_name'] ?? '' );
	$last_name = sanitize_text_field( $_POST['account_last_name'] ?? '' );
	$email = sanitize_email( $_POST['account_email'] ?? '' );
	$phone = sanitize_text_field( $_POST['billing_phone'] ?? '' );
	$activity = sanitize_text_field( $_POST['account_activity'] ?? '' );
	$goal = sanitize_text_field( $_POST['account_goal'] ?? '' );

  if(!$first_name || !$last_name || !$email || !$phone) {
    $contact_saved_error = 'Fill in all required fields';
  }
  else {
    wp_update_user( [
      'ID' => $current_user->ID,
      'first_name' => $first_name,
      'last_name' => $last_name,
      'user_email' => $email,
    ] );

    $customer->set_first_name( $first_name );
    $customer->set_last_name( $last_name );
    $customer->set_billing_phone( $phone );
    $customer->set_billing_email( $email );
    $customer->save();

    update_user_meta( $current_user->ID, 'account_activity', $activity );
    update_user_meta( $current_user->ID, 'account_goal', $goal );

    $contact_saved = true;
  }
}


/*
 * Save address data
 */
$address_saved = false;
$address_saved_error = '';

if ( 
  isset( $_POST['save_address_data'] ) && 
  isset( $_POST['address_data_nonce'] ) && 
  wp_verify_nonce( $_POST['address_data_nonce'], 'save_address_data' ) 
) {
  $billing_first_name =  sanitize_text_field( $_POST['billing_first_name'] ?? '' );
  $billing_last_name =  sanitize_text_field( $_POST['billing_last_name'] ?? '' );
  $billing_email =  sanitize_text_field( $_POST['billing_email'] ?? '' );
  $billing_country =  sanitize_text_field( $_POST['billing_country'] ?? '' );
  $billing_address_1 =  sanitize_text_field( $_POST['billing_address_1'] ?? '' );
  $billing_city =  sanitize_text_field( $_POST['billing_city'] ?? '' );
  $billing_state =  sanitize_text_field( $_POST['billing_state'] ?? '' );
  $billing_postcode =  sanitize_text_field( $_POST['billing_postcode'] ?? '' );

  if(
    !$billing_first_name || 
    !$billing_last_name || 
    !$billing_email || 
    !$billing_country
  ) {
    $address_saved_error = 'Fill in all required fields';
  } 
  else {
    $customer->set_billing_first_name($billing_first_name);
    $customer->set_billing_last_name($billing_last_name);
    $customer->set_billing_email($billing_email);
    $customer->set_billing_country($billing_country);

    if ( $billing_state !== '' ) {
      $customer->set_billing_state($billing_state);
    }
    if ( $billing_city !== '' ) {
      $customer->set_billing_city($billing_city);
    }
    if ( $billing_address_1 !== '' ) {
      $customer->set_billing_address_1($billing_address_1);
    }
    if ( $billing_postcode !== '' ) {
      $customer->set_billing_postcode($billing_postcode);
    }

    $customer->save();
    $address_saved = true;
  }
}

// Handle password change form submission
$password_changed = false;
$password_error = '';


if ( isset( $_POST['change_password_nonce'] ) && wp_verify_nonce( $_POST['change_password_nonce'], 'change_password_action' ) ) {
	$current_password = isset( $_POST['password_current'] ) ? $_POST['password_current'] : '';
	$new_password = isset( $_POST['password_1'] ) ? $_POST['password_1'] : '';
	$confirm_password = isset( $_POST['password_2'] ) ? $_POST['password_2'] : '';
	
	if ( empty( $current_password ) || empty( $new_password ) || empty( $confirm_password ) ) {
		$password_error = __( 'Please fill in all password fields.', 'woocommerce' );
	} elseif ( ! wp_check_password( $current_password, $current_user->user_pass, $current_user->ID ) ) {
		$password_error = __( 'Your current password is incorrect.', 'woocommerce' );
	} elseif ( $new_password !== $confirm_password ) {
		$password_error = __( 'New passwords do not match.', 'woocommerce' );
	} elseif ( strlen( $new_password ) < 8 ) {
		$password_error = __( 'Password must be at least 8 characters long.', 'woocommerce' );
	} else {
		wp_set_password( $new_password, $current_user->ID );

		$sessions = WP_Session_Tokens::get_instance( $current_user->ID );
		$sessions->destroy_all();

		wp_logout();
		wp_redirect( wc_get_page_permalink( 'myaccount' ) );
    	exit;
	} 
}
?>


<div class="woocommerce-account-fields">


	
	<?php if ( $contact_saved ) : ?>
		<div class="woocommerce-message" role="alert">
			<?php esc_html_e( 'Contact information updated.', 'woocommerce' ); ?>
		</div>
	<?php endif; ?>

  <?php if ( $contact_saved_error ) : ?>
    <div class="woocommerce-error" role="alert">
      <?php echo esc_html( $contact_saved_error ); ?>
    </div>
  <?php endif; ?>

	<div class="account-section | box flow">
		<h3><?php esc_html_e( 'Contact information', 'woocommerce' ); ?></h3>
		<form method="post" class="account-form account-form--contact ">
			<?php wp_nonce_field( 'save_contact_info', 'contact_info_nonce' ); ?>

			<p class="woocommerce-form-row form-row">
				<label class="required_field" for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?></label>
        <span class="required" aria-hidden="true">*</span>
				<input aria-required="true" type="text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $customer->get_first_name() ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label class="required_field" for="billing_phone"><?php esc_html_e( 'Phone number', 'woocommerce' ); ?></label>
        <span class="required" aria-hidden="true">*</span>
				<input aria-required="true" type="text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $customer->get_billing_phone() ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label class="required_field" for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?></label>
        <span class="required" aria-hidden="true">*</span>
				<input aria-required="true" type="text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $customer->get_last_name() ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_activity"><?php esc_html_e( 'Type of activity', 'woocommerce' ); ?></label>
				<input aria-required="true" type="text" name="account_activity" id="account_activity" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'account_activity', true ) ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label class="required_field" for="account_email"><?php esc_html_e( 'Email', 'woocommerce' ); ?></label>
        <span class="required" aria-hidden="true">*</span>
				<input aria-required="true" type="email" name="account_email" id="account_email" value="<?php echo esc_attr( $current_user->user_email ); ?>" />
			</p>
			<p class="woocommerce-form-row form-row">
				<label for="account_goal"><?php esc_html_e( 'Goal', 'woocommerce' ); ?></label>
				<input type="text" name="account_goal" id="account_goal" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'account_goal', true ) ); ?>" />
			</p>

			<p>
				<button type="submit" class="button" name="save_contact_info" value="1"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
			</p>
		</form>
	</div>

	<?php if ( $address_saved ) : ?>
		<div class="woocommerce-message" role="alert">
			<?php esc_html_e( 'Address updated.', 'woocommerce' ); ?>
		</div>
	<?php endif; ?>

  <?php if ( $address_saved_error ) : ?>
    <div class="woocommerce-error" role="alert">
      <?php echo esc_html( $address_saved_error ); ?>
    </div>
  <?php endif; ?>

	<div class="account-section | box flow">
		<h3><?php esc_html_e( 'Data', 'woocommerce' ); ?></h3>
		<form method="post" class="account-form account-form--data ">
			<?php wp_nonce_field( 'save_address_data', 'address_data_nonce' ); ?>
			<?php
			$countries = WC()->countries;

			$billing_fields = $countries->get_address_fields(
				$customer->get_billing_country(),
				'billing_'
			);

			foreach ( $billing_fields as $key => $field ) {

				$value = $customer->{"get_$key"}();

				woocommerce_form_field(
					$key,
					$field,
					$value
				);
			}
			?>

			<p>
				<button type="submit" class="button" name="save_address_data" value="1"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
			</p>
		</form>
	</div>
	
	<div class="account-section | box flow">
		<h3><?php esc_html_e( 'Change password', 'woocommerce' ); ?></h3>
		
		<?php if ( $password_changed ) : ?>
			<div class="woocommerce-message" role="alert">
				<?php esc_html_e( 'Password changed successfully!', 'woocommerce' ); ?>
			</div>
		<?php endif; ?>
		
		<?php if ( $password_error ) : ?>
			<div class="woocommerce-error" role="alert">
				<?php echo esc_html( $password_error ); ?>
			</div>
		<?php endif; ?>
		
		<form method="post" action="" class="account-form account-form--password ">
			<?php wp_nonce_field( 'change_password_action', 'change_password_nonce' ); ?>
			
			<?php
			woocommerce_form_field( 'password_current', [
				'type'        => 'password',
				'label'       => __( 'Current Password', 'woocommerce' ),
				'required'    => true,
				'class'       => [ 'form-row-wide' ],
				'custom_attributes' => [ 'autocomplete' => 'current-password' ],
			] );

			woocommerce_form_field( 'password_1', [
				'type'        => 'password',
				'label'       => __( 'New Password', 'woocommerce' ),
				'required'    => true,
				'class'       => [ 'form-row-wide' ],
				'custom_attributes' => [ 'autocomplete' => 'new-password' ],
			] );

			woocommerce_form_field( 'password_2', [
				'type'        => 'password',
				'label'       => __( 'Confirm New Password', 'woocommerce' ),
				'required'    => true,
				'class'       => [ 'form-row-wide' ],
				'custom_attributes' => [ 'autocomplete' => 'new-password' ],
			] );
			?>
		</form>
	</div>
	
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */




/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
