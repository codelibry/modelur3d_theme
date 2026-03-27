<?php

// Replace the default "order received" heading with a status-aware one
add_filter('woocommerce_thankyou_order_received_text', function ($text, $order) {
    if (!$order || $order->get_payment_method() !== 'transferty') {
        return $text;
    }

    $status = $order->get_status();

    if (in_array($status, ['pending', 'on-hold'])) {
        return '<span class="transferty-pending-msg">'
            . __('Your order has been received. Payment confirmation is in progress — your order will be confirmed shortly.', 'woocommerce')
            . '</span>';
    }

    return $text; // default "Thank you. Your order has been received." for completed/processing
}, 10, 2);

///// Refresh on-hold page

add_action('woocommerce_thankyou', function ($order_id) {
    $order = wc_get_order($order_id);
    if (!$order || $order->get_payment_method() !== 'transferty') return;

    if (in_array($order->get_status(), ['pending', 'on-hold'])) {
        echo '<script>
            setTimeout(function() {
                window.location.reload();
            }, 4000); // reload after 4 seconds
        </script>';
    }
}, 5);

add_action('woocommerce_thankyou', function ($order_id) {
    $order = wc_get_order($order_id);
    if (!$order || $order->get_payment_method() !== 'transferty') return;

    if (in_array($order->get_status(), ['pending', 'on-hold'])) {
        echo '<style>
            .woocommerce-order-overview,
            .woocommerce button.button,
            .woocommerce a.button,
            .order-again,
            .wc-item-meta,
            .woocommerce-order-details__title ~ a
        { display: none !important; }</style>';
    }
}, 5);