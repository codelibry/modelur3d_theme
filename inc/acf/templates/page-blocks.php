<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    ACFComposer::registerFieldGroup([
        'name'     => 'pageBlocks',
        'title'    => 'Page Blocks',
        'fields'   => [
            [
                'label'        => 'Blocks',
                'name'         => 'page-blocks',
                'type'         => 'flexible_content',
                'button_label' => 'Add Block',
                'layouts'      => [
                    [
                        'name'       => 'image-text',
                        'label'      => 'Image & Text',
                        'display'    => 'block',
                        'sub_fields' => codelibry_acf_fields_image_text(),
                    ],
                    [
                        'name'       => 'testimonials',
                        'label'      => 'Testimonials',
                        'display'    => 'block',
                        'sub_fields' => codelibry_acf_fields_testimonials(),
                    ],
                    [
                        'name'       => 'banner',
                        'label'      => 'Banner',
                        'display'    => 'block',
                        'sub_fields' => codelibry_acf_fields_banner(),
                    ],
                    [
                        'name'       => 'users',
                        'label'      => 'Users block',
                        'display'    => 'block',
                        'sub_fields' => codelibry_acf_fields_users(),
                    ],
                    [
                        'name'       => 'product-tab',
                        'label'      => 'Products tab',
                        'display'    => 'block',
                        'sub_fields' => codelibry_acf_fields_product_tab(),
                    ],
                    [
                        'name'       => 'reusable-block',
                        'label'      => 'Reusable Block',
                        'display'    => 'block',
                        'sub_fields' => [
                            [
                                'label'         => 'Reusable Block',
                                'name'          => 'reusable-block-post',
                                'type'          => 'post_object',
                                'post_type'     => ['reusable-blocks'],
                                'return_format' => 'id',
                                'multiple'      => 0,
                                'allow_null'    => 0,
                                'ui'            => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                ['param' => 'page_template', 'operator' => '==', 'value' => 'default'],
            ],
        ],
        'menu_order' => 0,
    ]);
});
