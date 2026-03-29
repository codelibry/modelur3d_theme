<?php

function codelibry_acf_fields_faq(): array {
    return [
        [
            'label'    => 'Title',
            'name'     => 'faq-title',
            'type'     => 'text',
            'required' => 0,
        ],
        [
            'label'        => 'Questions',
            'name'         => 'faq_item',
            'type'         => 'repeater',
            'layout'       => 'block',
            'limit'        => '4',
            'button_label' => 'Add Item',
            'sub_fields'   => [
                [
                    'label'        => 'Question',
                    'name'         => 'question',
                    'type'     => 'text'
                ],
                [
                    'label'        => 'Question',
                    'name'         => 'answer',
                    'type'     => 'text'
                ]
            ],
        ]
    ];
}
