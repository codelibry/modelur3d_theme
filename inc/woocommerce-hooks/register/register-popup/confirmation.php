<?php

/**
 * Email Confirmation Feature
 *
 * Flow:
 *  1. On registration, generate a token and store it in user meta.
 *  2. Cancel the WooCommerce auto-login so the user cannot access the account yet.
 *  3. After registration, redirect to the register page with ?registered=1
 *     so the shortcode can display a "check your email" notice.
 *  4. The confirmation link in the email points to /?confirm_email=<token>&uid=<user_id>
 *  5. On visit, validate the token, mark the user as confirmed, and redirect
 *     to the login page with ?confirmed=1.
 *  6. On login, reject unconfirmed users with a clear error message.
 */

defined( 'ABSPATH' ) || exit;


add_action( 'woocommerce_created_customer', 'modelur_generate_email_confirmation_token', 10, 1 );

function modelur_generate_email_confirmation_token( $customer_id ) {
    $token = bin2hex( random_bytes( 32 ) ); // 64-char hex token
    update_user_meta( $customer_id, '_email_confirmation_token', $token );
    update_user_meta( $customer_id, '_email_confirmed', '0' );
}


// The login-register.php shortcode has an auto-login hook on woocommerce_created_customer
// with priority 20. We run at priority 5 to remove auth cookies before they are set.
add_action( 'woocommerce_created_customer', 'modelur_prevent_autologin_unconfirmed', 5, 1 );

function modelur_prevent_autologin_unconfirmed( $customer_id ) {
    // Schedule a shutdown action to clear cookies that may have been set later
    add_action( 'shutdown', function() {
        wp_logout();
    } );
}

// Also remove auth cookie right after registration processing
add_action( 'woocommerce_register_post', 'modelur_cancel_autologin_cookie', 999, 3 );
function modelur_cancel_autologin_cookie( $username, $email, $validation_errors ) {
    if ( ! $validation_errors->get_error_codes() ) {
        add_action( 'wp_login', function( $user_login, $user ) {
            // This fires inside woocommerce_created_customer auto-login; clear it.
            wp_clear_auth_cookie();
        }, 10, 2 );
    }
}



add_filter( 'woocommerce_registration_redirect', 'modelur_registration_redirect', 20 );

function modelur_registration_redirect( $redirect ) {
    // Point to the register page (wherever [wc_reg_form_rs] lives)
    $register_page = get_page_by_path( 'register' );
    $base = $register_page ? get_permalink( $register_page ) : home_url();
    return add_query_arg( 'registered', '1', $base );
}


add_action( 'template_redirect', 'modelur_handle_email_confirmation' );

function modelur_handle_email_confirmation() {
    if ( ! isset( $_GET['confirm_email'], $_GET['uid'] ) ) {
        return;
    }

    $token   = sanitize_text_field( $_GET['confirm_email'] );
    $user_id = absint( $_GET['uid'] );

    if ( ! $user_id || ! $token ) {
        return;
    }

    $stored_token = get_user_meta( $user_id, '_email_confirmation_token', true );
    $confirmed    = get_user_meta( $user_id, '_email_confirmed', true );
    $my_account_url = wc_get_page_permalink( 'myaccount' );

    // 1. If already confirmed, log them in and go to My Account
    if ( $confirmed === '1' ) {
        wp_set_current_user( $user_id );
        wp_set_auth_cookie( $user_id );
        wp_safe_redirect( add_query_arg( 'confirmed', 'already', $my_account_url ) );
        exit;
    }

    // 2. Check token validity
    if ( ! hash_equals( $stored_token, $token ) ) {
        // For invalid tokens, we still go to login as they aren't authenticated
        $login_page = modelur_get_login_url();
        wp_safe_redirect( add_query_arg( 'confirmed', 'invalid', $login_page ) );
        exit;
    }

    // 3. Valid Token — Mark as confirmed
    update_user_meta( $user_id, '_email_confirmed', '1' );
    delete_user_meta( $user_id, '_email_confirmation_token' );

    // 4. Log the user in automatically
    wp_set_current_user( $user_id );
    wp_set_auth_cookie( $user_id );

    // 5. Redirect to My Account
    wp_safe_redirect( add_query_arg( 'confirmed', '1', $my_account_url ) );
    exit;
}


add_filter( 'wp_authenticate_user', 'modelur_block_unconfirmed_login', 10, 2 );

function modelur_block_unconfirmed_login( $user, $password ) {
    if ( is_wp_error( $user ) ) {
        return $user;
    }

    $confirmed = get_user_meta( $user->ID, '_email_confirmed', true );

    if ( $confirmed === '' ) {
        return $user;
    }

    if ( $confirmed !== '1' ) {
        return new WP_Error(
            'email_not_confirmed',
            sprintf(
                /* translators: %s: resend confirmation link */
                __( '<strong>Email not confirmed.</strong> Please check your inbox for the confirmation email and click the link inside. <a href="%s">Resend confirmation email</a>.', 'modelur3d' ),
                esc_url( add_query_arg( array(
                    'resend_confirmation' => '1',
                    'uid'                => $user->ID,
                ), wc_get_page_permalink( 'myaccount' ) ) )
            )
        );
    }

    return $user;
}


add_action( 'template_redirect', 'modelur_resend_confirmation_email' );

function modelur_resend_confirmation_email() {
    if ( ! isset( $_GET['resend_confirmation'], $_GET['uid'] ) ) {
        return;
    }

    $user_id = absint( $_GET['uid'] );
    if ( ! $user_id ) return;

    $confirmed = get_user_meta( $user_id, '_email_confirmed', true );
    if ( $confirmed === '1' ) return;

    // Generate a fresh token
    $token = bin2hex( random_bytes( 32 ) );
    update_user_meta( $user_id, '_email_confirmation_token', $token );

    $user = get_userdata( $user_id );
    if ( $user ) {
        modelur_send_confirmation_email( $user, $token );
        wc_add_notice( __( 'Confirmation email has been resent. Please check your inbox.', 'modelur3d' ), 'success' );
    }

    $login_url = modelur_get_login_url();
    wp_safe_redirect( $login_url );
    exit;
}


function modelur_get_confirmation_url( $user_id, $token ) {
    return add_query_arg(
        array(
            'confirm_email' => $token,
            'uid'           => $user_id,
        ),
        home_url( '/' )
    );
}


function modelur_get_login_url() {
    $login_page = get_page_by_path( 'login' );
    return $login_page ? get_permalink( $login_page ) : wp_login_url();
}


function modelur_send_confirmation_email( $user, $token ) {
    $confirm_url = modelur_get_confirmation_url( $user->ID, $token );
    $blogname    = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

    $subject = sprintf( __( 'Confirm your email for %s', 'modelur3d' ), $blogname );

    $message  = sprintf( __( 'Hi %s,', 'modelur3d' ), $user->display_name ) . "\n\n";
    $message .= sprintf( __( 'Please confirm your email address to activate your account on %s.', 'modelur3d' ), $blogname ) . "\n\n";
    $message .= __( 'Click the link below to confirm:', 'modelur3d' ) . "\n";
    $message .= $confirm_url . "\n\n";
    $message .= __( 'If you did not create an account, you can ignore this email.', 'modelur3d' );

    wp_mail( $user->user_email, $subject, $message );
}


add_action( 'template_redirect', 'modelur_handle_confirmation_notices' );

function modelur_handle_confirmation_notices() {
    if ( ! isset( $_GET['confirmed'] ) ) {
        return;
    }

    $state = sanitize_text_field( $_GET['confirmed'] );

    if ( $state === '1' ) {
        wc_add_notice(
            __( '<strong>Email confirmed!</strong> Your account is now active.', 'modelur3d' ),
            'success'
        );
    } elseif ( $state === 'already' ) {
        wc_add_notice(
            __( 'Your email is already confirmed.', 'modelur3d' ),
            'notice'
        );
    } elseif ( $state === 'invalid' ) {
        wc_add_notice(
            __( '<strong>Invalid confirmation link.</strong> The link may have expired. Please register again or contact support.', 'modelur3d' ),
            'error'
        );
    }
}