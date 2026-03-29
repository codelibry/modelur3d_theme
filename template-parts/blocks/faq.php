<?php
$args  = $args ?? [];

$title = get_array_value( $args, 'faq-title', get( 'faq-title' ) );
$items = get_array_value( $args, 'faq_item',  get( 'faq_item' ) );

$accordion_items = [];
if ( ! empty( $items ) ) {
    foreach ( $items as $item ) {
        $accordion_items[] = [
            'item_heading' => $item['question'] ?? '',
            'item_content' => $item['answer']   ?? '',
        ];
    }
}
?>

<section class="faq | section">
    <div class="container-sm">

        <?php if ( $title ) : ?>
            <div class="faq__title">
                <h2><?php echo esc_html( $title ); ?></h2>
            </div>
        <?php endif; ?>

        <div class="faq__questions" id="faq">
            <?php
            get_template_part( 'template-parts/parts/accordion', null, [
                'items' => $accordion_items,
            ] );
            ?>
        </div>

    </div>
</section>