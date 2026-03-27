<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => '404 Page',
            'menu_title'  => '404 Page',
            'menu_slug'   => 'theme-options-404',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => '404_options',
        'title'  => '404 Page Options',
        'fields' => [
            [
                'label'        => 'Content',
                'name'         => '404__content',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 0,
            ],
            [
                'label'         => 'Button',
                'name'          => '404__button',
                'type'          => 'link',
                'return_format' => 'array',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-404',
                ],
            ],
        ],
    ]);
});
