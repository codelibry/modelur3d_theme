<?php

/*
 * Label for sign in form
 */
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
  if ( $text === 'Login' && $domain === 'woocommerce' ) {
    $translated_text = 'Sign in'; // Change this to your desired text
  }

  return $translated_text;
}, 20, 3 );
