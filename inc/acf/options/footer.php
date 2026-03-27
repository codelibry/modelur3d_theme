<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page([
            'page_title'  => 'Footer',
            'menu_title'  => 'Footer',
            'menu_slug'   => 'theme-options-footer',
            'parent_slug' => 'theme-options',
            'capability'  => 'edit_theme_options',
        ]);
    }

    ACFComposer::registerFieldGroup([
        'name'   => 'footer_options',
        'title'  => 'Footer Options',
        'fields' => [
            [
                'label' => 'Footer Description',
                'name'  => 'footer__description',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'label' => 'Company Name',
                'name'  => 'footer__company-name',
                'type'  => 'text',
            ],
            [
                'label'         => 'Payment Methods Image',
                'name'          => 'footer__payment_methods',
                'type'          => 'image',
                'return_format' => 'id',
                'preview_size'  => 'thumbnail',
                'instructions'  => 'Upload an image showing accepted payment methods.',
            ],
            [
                'label'        => 'Social Links',
                'name'         => 'social_links',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add Social Link',
                'sub_fields'   => [
                    [
                        'label'   => 'Platform',
                        'name'    => 'platform',
                        'type'    => 'select',
                        'choices' => [
                            'facebook'  => 'Facebook',
                            'instagram' => 'Instagram',
                            'linkedin'  => 'LinkedIn',
                            'twitter'   => 'Twitter / X',
                            'youtube'   => 'YouTube',
                        ],
                    ],
                    [
                        'label' => 'URL',
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme-options-footer',
                ],
            ],
        ],
    ]);
});
