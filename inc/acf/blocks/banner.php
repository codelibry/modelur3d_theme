<?php

function codelibry_acf_fields_banner(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'        => 'Image',
            'name'         => 'banner-image',
            'type'         => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
            'required'     => 0,
            'wrapper'      => ['width' => '50'],
        ],
        [
            'label'    => 'Title',
            'name'     => 'banner-title',
            'type'     => 'text',
            'required' => 0,
        ],
        [
            'label'        => 'Text',
            'name'         => 'banner-text',
            'type'         => 'wysiwyg',
            'tabs'         => 'all',
            'toolbar'      => 'full',
            'media_upload' => 1,
            'required'     => 0,
        ],
        [
            'label'    => 'Button Color',
            'name'     => 'banner-button-color',
            'type'     => 'button_group',
            'choices'  => [
                'black' => 'Black',
                'white' => 'White',
            ],
            'default_value' => 'black',
            'wrapper'  => ['width' => '50'],
        ],
        [
            'label'         => 'Button',
            'name'          => 'banner-button',
            'type'          => 'link',
            'return_format' => 'array', 
            'required'      => 0
        ]
    ];
}
