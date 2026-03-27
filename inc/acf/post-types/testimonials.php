<?php

use ACFComposer\ACFComposer;

add_action('acf/init', function () {
    ACFComposer::registerFieldGroup([
        'name'     => 'testimonial',
        'title'    => 'Testimonial',
        'fields'   => [
            [
                'label' => 'Author Name',
                'name'  => 'author-name',
                'type'  => 'text',
            ],
            [
                'label' => 'Author Position',
                'name'  => 'author-position',
                'type'  => 'text',
            ],
            [
                'label'        => 'Content',
                'name'         => 'content',
                'type'         => 'wysiwyg',
                'media_upload' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'testimonials',
                ],
            ],
        ],
    ]);
});
