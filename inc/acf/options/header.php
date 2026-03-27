<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => 'Header',
            'menu_title'  => 'Header',
            'menu_slug'   => 'theme-options-header',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => 'header_options',
        'title'  => 'Header Options',
        'fields' => [
            [
                'label'         => 'CTA Button',
                'name'          => 'cta-button',
                'type'          => 'link',
                'return_format' => 'array',
            ],
            [
                'label'         => 'Login Popup',
                'name'          => 'header__login-popup',
                'type'          => 'true_false',
                'default_value' => 0,
                'ui'            => 1,
                'instructions'  => 'Enable popup login instead of redirecting to login page.',
            ],
            [
                'label'         => 'Search Variant',
                'name'          => 'header__search-variant',
                'type'          => 'select',
                'choices'       => [
                    'form'  => 'Form',
                    'popup' => 'Popup',
                ],
                'default_value' => 'form',
            ],
            [
                'label'         => 'Search Category Parameter',
                'name'          => 'header__search-cat',
                'type'          => 'select',
                'choices'       => [
                    'no'  => 'No',
                    'yes' => 'Yes',
                ],
                'default_value' => 'no',
                'instructions'  => 'Include category filter in search form.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-header',
                ],
            ],
        ],
    ]);
});
