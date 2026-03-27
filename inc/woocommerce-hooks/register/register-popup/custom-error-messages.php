<?php

/*
 * Custom error messages
 */
add_filter( 'woocommerce_add_error', function( $error ) {
  // Registration errors
  if ( strpos( $error, 'Please provide a valid email address.' ) !== false ) {
    $error = __( 'Your registration email format looks incorrect. Please double-check.', 'ragnarock' );
  }

  if ( strpos( $error, 'An account is already registered with your email address' ) !== false ) {
    $error = __( 'This email is already registered. Try logging in instead.', 'ragnarock' );
  }

  return $error;
}, 10 );
