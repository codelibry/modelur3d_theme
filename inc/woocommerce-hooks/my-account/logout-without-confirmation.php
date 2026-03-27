<?php

/*
 * Log out user without confirmation
 */
add_filter( 'logout_redirect', function( $redirect_to, $requested_redirect_to, $user ) {
  return home_url();
}, 10, 3 );
