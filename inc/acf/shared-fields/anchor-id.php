<?php

function codelibry_acf_shared_field_anchor_id(): array {
    return [
        'label'        => 'Anchor ID',
        'name'         => 'anchor-id',
        'type'         => 'text',
        'instructions' => 'Used for anchor links. Enter an ID (without #) to link directly to this block, e.g. "my-section" will be accessible via #my-section.',
        'required'     => 0,
    ];
}
