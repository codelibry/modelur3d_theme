<?php

function codelibry_acf_fields_how_work(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'        => 'Image',
            'name'         => 'how-image',
            'type'         => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
            'required'     => 0,
            'wrapper'      => ['width' => '50'],
        ],
        [
            'label'    => 'Title',
            'name'     => 'how-title',
            'type'     => 'text',
            'required' => 0,
        ],
        [
            'label'        => 'Text',
            'name'         => 'how-text',
            'type'         => 'wysiwyg',
            'tabs'         => 'all',
            'toolbar'      => 'full',
            'media_upload' => 1,
            'required'     => 0,
        ],
        [
            'label'        => 'Items',
            'name'         => 'how_item',
            'type'         => 'repeater',
            'layout'       => 'block',
            'limit'        => '3',
            'button_label' => 'Add Item',
            'sub_fields'   => [
                [
                    'label'         => 'Icon',
                    'name'          => 'icon',
                    'type'          => 'file',
                    'return_format' => 'array'
                ],
                [
                    'label'        => 'Text',
                    'name'         => 'text',
                    'type'         => 'wysiwyg',
                    'tabs'         => 'all',
                    'toolbar'      => 'full',   
                    'media_upload' => 0,
                ]
            ],
        ]
    ];
}
