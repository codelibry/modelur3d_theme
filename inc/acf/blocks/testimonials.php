<?php

function codelibry_acf_fields_testimonials(): array {
    return [
        [
            'label'    => 'Title',
            'name'     => 'testimonials-title',
            'type'     => 'text',
            'required' => 0,
        ],
        [
            'label'    => 'Subtitle',
            'name'     => 'testimonials-subtitle',
            'type'     => 'textarea',
            'rows'     => 3,
            'required' => 0,
        ],
        [
            'label'         => 'Button',
            'name'          => 'testimonials-button',
            'type'          => 'link',
            'return_format' => 'array',
            'required'      => 0,
        ],
    ];
}
