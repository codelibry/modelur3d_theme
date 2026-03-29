<?php
$args  = $args ?? [];
$items = get_array_value( $args, 'items', [] );

if ( empty( $items ) ) {
    return;
}

$accordion_id = 'accordion-' . uniqid();
?>

<div class="accordion" id="<?php echo esc_attr( $accordion_id ); ?>">

    <div class="accordion-list">
        <?php foreach ( $items as $index => $item ) :
            $heading = $item['item_heading'] ?? '';
            $content = $item['item_content'] ?? '';

            if ( ! $heading && ! $content ) {
                continue;
            }

            $item_id  = $accordion_id . '-item-' . $index;
            $panel_id = $item_id . '-panel';
            $is_first = ( $index === 0 );
        ?>
            <div class="accordion-item<?php echo $is_first ? ' active' : ''; ?>"
                 id="<?php echo esc_attr( $item_id ); ?>">

                <button
                    class="accordion-header"
                    aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                    aria-controls="<?php echo esc_attr( $panel_id ); ?>"
                >
                    <?php echo esc_html( $heading ); ?>
                </button>

                <div
                    class="accordion-content"
                    id="<?php echo esc_attr( $panel_id ); ?>"
                    role="region"
                    <?php echo $is_first ? '' : 'hidden'; ?>
                >
                    <div class="accordion-content-inner">
                        <?php echo wp_kses_post( $content ); ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

</div>