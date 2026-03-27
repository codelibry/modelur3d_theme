<?php

add_action( 'login_form_lostpassword', function() {
    if ( isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] === 'confirm' ) {
        $referer = wp_get_referer();
        if ( $referer ) {
            wp_safe_redirect( add_query_arg( 'reset-link-sent', 'true', $referer ) );
        } else {
            wp_safe_redirect( home_url( '/login/?reset-link-sent=true' ) );
        }
        exit;
    }
});

add_filter( 'lostpassword_redirect', function( $redirect ) {
    $referer = wp_get_referer();
    if ( $referer && strpos( $referer, home_url() ) === 0 ) {
        return $referer;
    }
    return $redirect;
});

add_action( 'wp', function() {
    if ( ! isset( $_POST['wc_reset_password'] ) ) return;

    $notices = WC()->session->get( 'wc_notices', [] );
    $message = ! empty( $notices['error'][0]['notice'] )
               ? wp_strip_all_tags( $notices['error'][0]['notice'] )
               : __( 'Something went wrong. Please check the correctness of the entered data', 'ragnarock' );


    if ( strpos( $message, 'Invalid username or email' ) !== false ) {
        $message = __( "No account found with that email address.", 'ragnarock' );
    } elseif ( strpos( $message, 'Password reset is not allowed' ) !== false ) {
        $message = __( 'Password reset is not allowed for this account.', 'ragnarock' );
    }

    $origin = ! empty( $_POST['_wp_http_referer'] )
              ? home_url( $_POST['_wp_http_referer'] )
              : home_url( '/' );

    wp_safe_redirect( add_query_arg( 'reset-error', urlencode( $message ), $origin ) . '#popup-reset-form' );
    exit;
});