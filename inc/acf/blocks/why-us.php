<?php

function codelibry_acf_fields_why_us(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'    => 'Title',
            'name'     => 'why-title',
            'type'     => 'text',
            'required' => 0,
        ],
        [
            'label'        => 'Items',
            'name'         => 'why_item',
            'type'         => 'repeater',
            'layout'       => 'block',
            'limit'        => '4',
            'button_label' => 'Add Item',
            'sub_fields'   => [
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
