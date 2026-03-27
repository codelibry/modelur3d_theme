<?php
$title = get_array_value($args, 'product-tab-title', get('product-tab-title'));

$tabs = [
    'bestseller'      => ['label' => 'Bestsellers',     'query' => ['meta_key' => 'total_sales', 'orderby' => 'meta_value_num', 'order' => 'DESC']],
    'top_rated'       => ['label' => 'Top Rated',       'query' => ['meta_key' => '_wc_average_rating', 'orderby' => 'meta_value_num', 'order' => 'DESC']],
    'all'             => ['label' => 'All',              'query' => ['orderby' => 'date', 'order' => 'DESC']],
    'recently_added'  => ['label' => 'Recently Added',  'query' => ['orderby' => 'date', 'order' => 'DESC', 'date_query' => [['after' => '30 days ago']]]],
];

$active_tab = isset($_GET['tab']) && array_key_exists($_GET['tab'], $tabs) ? sanitize_key($_GET['tab']) : 'all';
$posts_per_page = 8;
?>

<section class="product-tab | section">
    <div class="container">
        <div class="product-tab__top">
            <?php if ($title): ?>
                <h2><?php echo wp_kses_post($title); ?></h2>
            <?php endif; ?>

            <div class="tabs">
                <?php foreach ($tabs as $key => $tab): ?>
                    <button
                        class="tabs__btn button <?php echo $active_tab === $key ? 'is-active' : ''; ?>"
                        data-tab="<?php echo esc_attr($key); ?>"
                    >
                        <?php echo esc_html($tab['label']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="product-tab__content">
            <?php foreach ($tabs as $key => $tab): ?>
                <div
                    class="product-tab__panel <?php echo $active_tab === $key ? 'is-active' : ''; ?>"
                    data-panel="<?php echo esc_attr($key); ?>"
                >
                    <?php
                    $query_args = array_merge([
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'posts_per_page' => $posts_per_page,
                        'tax_query'      => [[
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'exclude-from-catalog',
                            'operator' => 'NOT IN',
                        ]],
                    ], $tab['query']);

                    $products = new WP_Query($query_args);

                    if ($products->have_posts()):
                    ?>
                        <ul class="products-grid products">
                            <?php while ($products->have_posts()): $products->the_post();
                                global $product;
                            ?>

                                <?php wc_get_template_part('content', 'product'); ?>

                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p class="product-tab__empty">No products found.</p>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
