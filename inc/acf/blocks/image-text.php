<?php

function codelibry_acf_fields_image_text(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'         => 'Image Position',
            'name'          => 'image-text-image-position',
            'type'          => 'button_group',
            'choices'       => [
                'left'  => '<span class="dashicons dashicons-align-pull-left"></span>',
                'right' => '<span class="dashicons dashicons-align-pull-right"></span>',
            ],
            'default_value' => 'left',
            'return_format' => 'value',
            'required'      => 0,
            'wrapper'       => ['width' => '50'],
        ],
        [
            'label'        => 'Image',
            'name'         => 'image-text-image',
            'type'         => 'image',
            'return_format' => 'id',
            'preview_size' => 'medium',
            'required'     => 0,
            'wrapper'      => ['width' => '50'],
        ],
        [
            'label'        => 'Text',
            'name'         => 'image-text-text',
            'type'         => 'wysiwyg',
            'tabs'         => 'all',
            'toolbar'      => 'full',
            'media_upload' => 1,
            'required'     => 0,
        ],
    ];
}
