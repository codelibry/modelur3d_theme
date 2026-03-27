<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    ACFComposer::registerFieldGroup([
        'name'   => 'reusableBlocks',
        'title'  => 'Reusable Block',
        'fields' => [
            [
                'label'        => 'Blocks',
                'name'         => 'reusable-blocks',
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
                ],
            ],
        ],
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'reusable-blocks'],
            ],
        ],
    ]);
});
