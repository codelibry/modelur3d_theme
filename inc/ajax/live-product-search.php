<?php

function live_product_search_ajax() {
    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
        's'              => $query,
        'post_status'    => 'publish',
    );

    if ($category) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ],
        ];
    }


    $products = get_posts($args);

    if (empty($products)) {
        ?>
            <li class="no-results"><?php esc_html_e('No products found.', 'codelibry') ?></li>
        <?php
        wp_die();
    }

    foreach ($products as $post):
        $product = wc_get_product($post->ID);
        get_template_part('template-parts/parts/product-search-item', null, ['product' => $product]);
    endforeach; 

    wp_die();
}

add_action('wp_ajax_live_product_search', 'live_product_search_ajax');
add_action('wp_ajax_nopriv_live_product_search', 'live_product_search_ajax');
