<?php
/**
 * Ragnarock My Account navigation
 */
add_filter( 'woocommerce_account_menu_items', function ( $items ) {

    /*
     * 1. Remove ONLY unwanted Woo defaults
     */
    $remove = [
        'downloads',
        'edit-address',
        'edit-account',
        'payment-methods',
        'my-wishlist',
        'vendor-withdrawal', 
        'balance',
        'logout',
        'inventory'
    ];

    foreach ( $remove as $key ) {
        unset( $items[ $key ] );
    }

    /*
     * 2. Rename existing endpoints
     */

    if ( isset( $items['add_balance'] ) ) {
        $items['add_balance'] = __( 'My Balance', 'ragnarock' );
    }



    /*
     * 3. Sort but KEEP plugin endpoints
     */
    $priority = [
        'dashboard',
        'orders',
    ];

    $sorted = [];

    // Theme order
    foreach ( $priority as $key ) {
        if ( isset( $items[ $key ] ) ) {
            $sorted[ $key ] = $items[ $key ];
        }
    }

    // Anything added by plugins or other items (except logout)
    foreach ( $items as $key => $label ) {
        if ( $key !== 'customer-logout' && ! isset( $sorted[ $key ] ) ) {
            $sorted[ $key ] = $label;
        }
    }

    // Logout always last
    if ( isset( $items['customer-logout'] ) ) {
        $sorted['customer-logout'] = $items['customer-logout'];
    }

    return $sorted;

}, 50 );

