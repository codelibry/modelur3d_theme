<?php get_header();?>

<?php

global $post;
$post_slug = $post->post_name;
?>

  <main class="main" id="main">

      <!-- Woocommerce Singular Page -->
      <?php if(is_cart() || is_checkout() || is_account_page() || is_page( 'wishlist' )): ?>
          <div class="woocommerce-page">
              <div class="container">
                  <h1 class="woocommerce-page__title | h2">
                      <?php the_title(); ?>
                  </h1>

                  <?php the_content(); ?>
              </div>
          </div>

      <?php else: ?>

          <div class="singular-page">
              <div class="container-sm">
                    <?php if($post_slug !== 'register' && $post_slug !== 'login'): ?>
                        <h1 class="singular-page__title | h2">
                            <?php the_title(); ?>
                        </h1>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>
              </div>
          </div>

      <?php endif; ?>

  </main>

<?php get_footer();?>
