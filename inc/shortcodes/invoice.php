<?php 
//// Code for adding licens key or similar field on your invoice.
//// Firest part add them to orders editor
// 1. Show Licence Key in admin order item
add_action('woocommerce_before_save_order_item', 'save_multiple_licence_keys', 10, 2);
function save_multiple_licence_keys($item, $item_object = null) {
    if (!is_a($item, 'WC_Order_Item_Product')) return;
    $item_id = $item->get_id();

    if (isset($_POST['licence_key'][$item_id]) && is_array($_POST['licence_key'][$item_id])) {
        $cleaned_keys = array_map('sanitize_text_field', $_POST['licence_key'][$item_id]);
        wc_update_order_item_meta($item_id, '_licence_keys', $cleaned_keys); // Store as array
    }
}


// 2. Save the field value
add_action('woocommerce_before_order_itemmeta', 'add_multiple_licence_keys_fields', 10, 3);
function add_multiple_licence_keys_fields($item_id, $item, $order) {
    $qty = $item->get_quantity();
    $keys = (array) wc_get_order_item_meta($item_id, '_licence_keys');

    echo '<div class="form-field form-field-wide"><label>Licence Keys:</label>';
    for ($i = 0; $i < $qty; $i++) {
        $key = $keys[$i] ?? '';
        echo '<input type="text" name="licence_key[' . $item_id . '][]" value="' . esc_attr($key) . '" style="margin-bottom:5px;" />';
    }
    echo '</div>';
}

// 3. (Optional) Show on admin order view
add_filter('woocommerce_display_item_meta', 'display_all_licence_keys', 10, 3);
function display_all_licence_keys($html, $item, $args) {
    $keys = (array) $item->get_meta('_licence_keys');
    if (!empty($keys)) {
        $html .= '<br><strong>Licence Keys:</strong><br>';
        foreach ($keys as $i => $key) {
            $html .= 'Key ' . ($i + 1) . ': ' . esc_html($key) . '<br>';
        }
    }
    return $html;
}
//Custom table for invoice
add_filter('wf_pklist_alter_find_replace', 'wf_pklist_add_license_table_placeholder', 10, 5);
function wf_pklist_add_license_table_placeholder($find_replace, $template_type, $order, $box_packing, $order_package) {
    if ($template_type !== 'invoice') return $find_replace;

    ob_start();
    ?>
    <table border="0" class="license_table" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Game</th>
                <th>Console</th>
                <th>Key</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order->get_items() as $item) :
                $product = $item->get_product();
                if (!$product) continue;

                $product_name = $item->get_name();
                $platform = $product->get_attribute('pa_platform');
                $keys = (array) $item->get_meta('_licence_keys');
                $qty = $item->get_quantity();

                for ($i = 0; $i < $qty; $i++) :
                    $key = $keys[$i] ?? '';
                    ?>
                    <tr>
                        <td class="product_name_td"><?php echo esc_html($product_name); ?></td>
                        <td><?php echo esc_html($platform); ?></td>
                        <td><?php echo esc_html($key); ?></td>
                    </tr>
                <?php endfor;
            endforeach; ?>
        </tbody>
    </table>
    <?php

    $table_html = ob_get_clean();
    $find_replace['[wfte_license_table]'] = $table_html;

    return $find_replace;
}

///Integration of global acf fields inside invoice
add_filter( 'wf_pklist_alter_find_replace', 'codelibry_add_acf_placeholders', 10, 5 );
function codelibry_add_acf_placeholders( $find_replace, $template_type, $order, $box_packing, $order_package ) {
    // You can scope to invoice only, or allow in all docs
    if ( $template_type !== 'invoice' ) {
        return $find_replace;
    }

    // Example: ACF option fields
    $company_phone   = get_field( 'company_phone', 'option' );
    $company_email   = get_field( 'company_email', 'option' );
    $company_manager = get_field( 'company_manager', 'option' );

    // Simple replacements
    $find_replace['[acf_company_phone]']   = esc_html( $company_phone );
    $find_replace['[acf_company_email]']   = esc_html( $company_email );
    $find_replace['[acf_company_manager]'] = esc_html( $company_manager );

    // Example: Build a mini HTML block with multiple fields
    ob_start();
    ?>
    <div class="acf_company_block" style="margin-top:10px; font-size:12px;">
        <p><strong>Phone:</strong> <?php echo esc_html( $company_phone ); ?></p>
        <p><strong>Email:</strong> <?php echo esc_html( $company_email ); ?></p>
        <p><strong>Manager:</strong> <?php echo esc_html( $company_manager ); ?></p>
    </div>
    <?php
    $block_html = ob_get_clean();

    $find_replace['[acf_company_block]'] = $block_html;

    return $find_replace;
}


// Show site domain
add_filter( 'wf_pklist_alter_find_replace', 'codelibry_add_site_url_www_placeholder', 10, 5 );
function codelibry_add_site_url_www_placeholder( $find_replace, $template_type, $order, $box_packing, $order_package ) {
    // Optional: limit to invoice templates only
    if ( $template_type !== 'invoice' ) {
        return $find_replace;
    }

    // get the host part of the site URL
    $site_url = home_url();
    $host = parse_url( $site_url, PHP_URL_HOST );
    if ( ! $host ) {
        // fallback if parse_url fails
        $host = preg_replace( '#^https?://#', '', rtrim( $site_url, '/' ) );
    }

    // Set to true if you want to ALWAYS prepend "www." when reasonable
    $force_www = true;

    if ( $force_www ) {
        // skip localhost and raw IPs
        if ( ! preg_match( '/^(localhost|\d{1,3}(?:\.\d{1,3}){3})$/', $host ) ) {
            if ( strpos( $host, 'www.' ) !== 0 ) {
                $host = 'www.' . $host;
            }
        }
    }

    $find_replace['[site_url_www]'] = esc_html( $host );

    return $find_replace;
}

/// More structured shipping and from
add_filter( 'wf_pklist_alter_find_replace', 'codelibry_add_shipping_and_store_detailed_fixed', 10, 5 );
function codelibry_add_shipping_and_store_detailed_fixed( $find_replace, $template_type, $order, $box_packing, $order_package ) {
    if ( $template_type !== 'invoice' ) {
        return $find_replace;
    }

    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
        return $find_replace;
    }

    // Always get shipping address array, fallback to billing if empty
    $shipping = $order->get_address( 'shipping' );
    if ( empty( array_filter( $shipping ) ) ) {
        $shipping = $order->get_address( 'billing' );
    }

    ob_start();
    ?>
    <div class="shipping_block">
        <span><strong>Shipping to</strong></span><br>
        <?php if ( ! empty( $shipping['address_1'] ) ) : ?>
            <span>Address 1:</span> <span><?php echo esc_html( $shipping['address_1'] ); ?></span><br>
        <?php endif; ?>
        <?php if ( ! empty( $shipping['address_2'] ) ) : ?>
            <span>Address 2:</span> <span><?php echo esc_html( $shipping['address_2'] ); ?></span><br>
        <?php endif; ?>
        <?php if ( ! empty( $shipping['city'] ) ) : ?>
            <span>City:</span> <span><?php echo esc_html( $shipping['city'] ); ?></span><br>
        <?php endif; ?>
        <?php if ( ! empty( $shipping['postcode'] ) ) : ?>
            <span>Zip:</span> <span><?php echo esc_html( $shipping['postcode'] ); ?></span><br>
        <?php endif; ?>
        <?php if ( ! empty( $shipping['state'] ) ) : ?>
            <span>State:</span> <span><?php echo esc_html( $shipping['state'] ); ?></span><br>
        <?php endif; ?>
        <?php if ( ! empty( $shipping['country'] ) ) : ?>
            <span>Country:</span> <span><?php echo esc_html( $shipping['country'] ); ?></span><br>
        <?php endif; ?>
    </div>
    <?php
    $find_replace['[shipping_block]'] = ob_get_clean();

    // --- Store detailed block ---
    $store_address   = get_option( 'woocommerce_store_address' );
    $store_address_2 = get_option( 'woocommerce_store_address_2' );
    $store_city      = get_option( 'woocommerce_store_city' );
    $store_postcode  = get_option( 'woocommerce_store_postcode' );
    $store_country   = get_option( 'woocommerce_default_country' );

    ob_start();
    ?>
    <div class="store_block">
        <span><strong>Store address</strong></span><br>
        <?php if ( $store_address ) : ?>
            <span>Address 1:</span> <span><?php echo esc_html( $store_address ); ?></span><br>
        <?php endif; ?>
        <?php if ( $store_address_2 ) : ?>
            <span>Address 2:</span> <span><?php echo esc_html( $store_address_2 ); ?></span><br>
        <?php endif; ?>
        <?php if ( $store_city ) : ?>
            <span>City:</span> <span><?php echo esc_html( $store_city ); ?></span><br>
        <?php endif; ?>
        <?php if ( $store_postcode ) : ?>
            <span>Zip:</span> <span><?php echo esc_html( $store_postcode ); ?></span><br>
        <?php endif; ?>
        <?php if ( $store_country ) : ?>
            <span>Country:</span> <span><?php echo esc_html( $store_country ); ?></span><br>
        <?php endif; ?>
    </div>
    <?php
    $find_replace['[store_block]'] = ob_get_clean();

    return $find_replace;
}


//// Show price in text format
add_filter( 'wf_pklist_alter_find_replace', 'codelibry_add_order_total_in_words', 10, 5 );
function codelibry_add_order_total_in_words( $find_replace, $template_type, $order, $box_packing, $order_package ) {
    if ( $template_type !== 'invoice' ) {
        return $find_replace;
    }

    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) {
        return $find_replace;
    }

    $total    = $order->get_total();
    $currency = $order->get_currency();

    // Convert total to words (simple function)
    $words = codelibry_number_to_words( $total );

    $find_replace['[order_total_words]'] = esc_html( $words . ' ' . $currency );

    return $find_replace;
}

// Simple number to words converter (supports integers and decimals)
function codelibry_number_to_words( $number ) {
    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $f->format($number);
}
