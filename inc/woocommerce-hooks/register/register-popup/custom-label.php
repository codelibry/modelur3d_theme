<?php

/*
 * Label for sign up form
 */
add_filter( 'gettext', function( $translated_text, $text, $domain ) {
  if ( $text === 'Register' && $domain === 'woocommerce' ) {
    $translated_text = esc_html('Sign up', 'ragnarock'); // Change this to your desired text
  }

  return $translated_text;
}, 20, 3 );
