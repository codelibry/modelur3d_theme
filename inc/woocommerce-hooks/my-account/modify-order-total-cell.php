<?php

/*
 *
 * Hook to override "Fox Currency Switcher" filter in /my-account/orders tab
 * and display plain total value 
 *
 * Example: 
 * Display just "€21.92" instead of "€21.92 for 4 items"
 *
 */
add_action('init', function () {
    global $wp_filter;

    $hook = 'woocommerce_my_account_my_orders_column_order-total';

    foreach ($wp_filter[$hook]->callbacks[777] ?? [] as $id => $callback) {
        if (
            is_array($callback['function']) &&
            is_object($callback['function'][0]) &&
            method_exists($callback['function'][0], 'override_my_account_orders')
        ) {
            remove_action($hook, [$callback['function'][0], 'override_my_account_orders'], 777);
        }
    }

    add_action($hook, function($order) {
        if (!is_a($order, 'WC_Order')) return;

        // display total value without "for X items"
        echo wp_kses_post($order->get_formatted_order_total());
    }, 9999);
});
