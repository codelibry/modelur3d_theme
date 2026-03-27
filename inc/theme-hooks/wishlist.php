<?php

add_action( 'wp_enqueue_scripts', function() {
    // Remove YITH Wishlist JavaScript
    wp_dequeue_script( 'jquery-yith-wcwl' ); // main wishlist script
    wp_deregister_script( 'jquery-yith-wcwl' );

    wp_dequeue_script( 'jquery-selectBox' ); // selectBox script
    wp_deregister_script( 'jquery-selectBox' );

    wp_dequeue_script( 'prettyPhoto' ); // prettyPhoto (used for popup)
    wp_deregister_script( 'prettyPhoto' );

    // Optional: remove YITH CSS as well if not already done
    wp_dequeue_style( 'yith-wcwl-main' );
    wp_dequeue_style( 'yith-wcwl-font-awesome' );
}, 999999 );
