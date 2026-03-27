<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => 'Company Info',
            'menu_title'  => 'Company Info',
            'menu_slug'   => 'theme-options-company',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => 'company_options',
        'title'  => 'Company Info',
        'fields' => [
            [
                'label' => 'Phone',
                'name'  => 'company_phone',
                'type'  => 'text',
            ],
            [
                'label' => 'Email',
                'name'  => 'company_email',
                'type'  => 'email',
            ],
            [
                'label' => 'Manager',
                'name'  => 'company_manager',
                'type'  => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-company',
                ],
            ],
        ],
    ]);
});
