<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => 'Single Product',
            'menu_title'  => 'Single Product',
            'menu_slug'   => 'theme-options-single-product',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => 'single_product_options',
        'title'  => 'Single Product Options',
        'fields' => [
            [
                'label' => 'Related Products Title',
                'name'  => 'related-products__title',
                'type'  => 'text',
            ],
            [
                'label' => 'Related Products Subtitle',
                'name'  => 'related-products__subtitle',
                'type'  => 'textarea',
                'rows'  => 2,
            ],
            [
                'label'         => 'Related Products Button',
                'name'          => 'related-products__button',
                'type'          => 'link',
                'return_format' => 'array',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-single-product',
                ],
            ],
        ],
    ]);
});
