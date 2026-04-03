<?php
add_action( 'woocommerce_before_checkout_form', 'custom_checkout_html_login_message', 5 );

function custom_checkout_html_login_message() {
    if ( ! is_user_logged_in() && ! WC()->checkout()->is_registration_enabled() && WC()->checkout()->is_registration_required() ) {
        echo '<div class="woocommerce-info">Please <a href="#popup-login-form" style="color: var(--color-blakc)">log in here</a> to complete your purchase.</div>';
        
        remove_filter( 'woocommerce_checkout_must_be_logged_in_message', '__return_empty_string' ); 
        add_filter( 'woocommerce_checkout_must_be_logged_in_message', '__return_empty_string' );
    }
}