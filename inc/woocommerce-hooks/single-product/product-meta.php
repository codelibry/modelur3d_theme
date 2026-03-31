<?php
/**
 * Show attr and categorie of product
 */
function custom_product_meta_block() {
    global $product;

    if ( ! $product ) {
        return;
    }

    $rows = [];

    // 1. Categories
    $category_terms = get_the_terms( $product->get_id(), 'product_cat' );

    if ( ! empty( $category_terms ) && ! is_wp_error( $category_terms ) ) {
        $category_names = wp_list_pluck( $category_terms, 'name' );

        $rows[] = [
            'label' => __( 'Categories', 'your-textdomain' ),
            'value' => implode( ' | ', $category_names ),
        ];
    }

    // 2. Product Attributes
    $attributes = $product->get_attributes();

    foreach ( $attributes as $attribute ) {

        if ( ! $attribute->get_visible() ) {
            continue;
        }

        if ( $attribute->is_taxonomy() ) {
            $taxonomy = $attribute->get_taxonomy_object();
            $label    = $taxonomy ? $taxonomy->attribute_label : wc_attribute_label( $attribute->get_name() );
        } else {
            $label = wc_attribute_label( $attribute->get_name() );
        }

        if ( $attribute->is_taxonomy() ) {
            $terms = $attribute->get_terms(); 
            if ( empty( $terms ) ) {
                continue;
            }
            $values = implode( ' | ', wp_list_pluck( $terms, 'name' ) );
        } else {
            $values = implode( ' | ', $attribute->get_options() );
        }

        if ( empty( $values ) ) {
            continue;
        }

        $rows[] = [
            'label' => $label,
            'value' => $values,
        ];
    }

    // Render 
    if ( empty( $rows ) ) {
        return;
    }

    echo '<div class="custom-product-meta-block">';
    echo '<h4 class="custom-product-meta-block__title">' . esc_html__( 'Product Details', 'your-textdomain' ) . '</h4>';

    foreach ( $rows as $row ) {
        echo '<div class="custom-product-meta-block__row">';
            echo '<span class="custom-product-meta-block__name">'  . esc_html( $row['label'] ) . '</span>';
            echo '<span class="custom-product-meta-block__value">' . esc_html( $row['value'] ) . '</span>';
        echo '</div>';
    }

    echo '</div>';
}