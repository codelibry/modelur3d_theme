<?php 

function codelibry_acf_fields_users(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'        => 'Users Items',
            'name'         => 'users_item',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add Item',
            'sub_fields'   => [
                [
                    'label'         => 'Image',
                    'name'          => 'image',
                    'type'          => 'image',
                    'return_format' => 'id',
                    'preview_size'  => 'thumbnail',
                    'wrapper'       => ['width' => '25'],
                ],
                [
                    'label'   => 'Title',
                    'name'    => 'title',
                    'type'    => 'text',
                    'wrapper' => ['width' => '75'],
                ],
                [
                    'label'        => 'Text',
                    'name'         => 'text',
                    'type'         => 'wysiwyg',
                    'tabs'         => 'visual',
                    'toolbar'      => 'basic',
                    'media_upload' => 0,
                ],
                [
                    'label'         => 'Button',
                    'name'          => 'button',
                    'type'          => 'link',
                    'return_format' => 'array',
                ],
            ],
        ],
    ];
}