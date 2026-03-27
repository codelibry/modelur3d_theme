<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => 'Shop',
            'menu_title'  => 'Shop',
            'menu_slug'   => 'theme-options-shop',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => 'shop_options',
        'title'  => 'Shop Options',
        'fields' => [
            [
                'label'         => 'Shop Banner Image',
                'name'          => 'shop-banner__image',
                'type'          => 'image',
                'return_format' => 'id',
                'preview_size'  => 'medium',
            ],
            [
                'label' => 'Shop Banner Title',
                'name'  => 'shop-banner__title',
                'type'  => 'text',
            ],
            [
                'label' => 'Shop Banner Description',
                'name'  => 'shop-banner__description',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-shop',
                ],
            ],
        ],
    ]);
});
