<?php

function codelibry_acf_fields_product_tab(): array {
    return [
        codelibry_acf_shared_field_anchor_id(),
        [
            'label'    => 'Title',
            'name'     => 'product-tab-title',
            'type'     => 'text',
            'required' => 0,
        ],
    ];
}
