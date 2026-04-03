<?php

/*
 * Custom error messages
 */

add_action( 'wp', function() {
    if ( ! isset( $_POST['wc_reset_password'] ) ) return;

    // Store the error in a transient tied to the session
    $notices = WC()->session->get( 'wc_notices', [] );
    if ( empty( $notices['error'] ) ) return;

    $message = wp_strip_all_tags( $notices['error'][0]['notice'] );

    if ( strpos( $message, 'Invalid username or email' ) !== false ) {
        $message = __( "We couldn't find an account with that email address.", 'ragnarock' );
    } elseif ( strpos( $message, 'Password reset is not allowed' ) !== false ) {
        $message = __( 'Password reset is not allowed for this account.', 'ragnarock' );
    }

    // Store in transient for 60 seconds — enough to survive the redirect
    set_transient( 'reset_error_' . WC()->session->get_customer_id(), $message, 60 );
}, 20 );


add_action( 'woocommerce_resetpassword_form', function () {
    $reset_error = ! empty( $_GET['reset-error'] ) ? urldecode( $_GET['reset-error'] ) : '';
    if ( ! $reset_error ) {
        return;
    }
    ?>
    <div class="auth-error woocommerce-error">
        <h4 class="auth-error__title"><?php esc_html_e( 'Reset failed', 'ragnarock' ); ?></h4>
        <p class="auth-error__text"><?php echo esc_html( $reset_error ); ?></p>
    </div>
    <?php
} );