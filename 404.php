<?php 

get_header();

$content = get('404__content', $options = true) ?? '<h1>404</h1><p class="h6">The page you were looking for, does not exist</p>';
$button = get('404__button', $options = true);

?>

<main class="not-found" id="main">
  <section class="not-found | section">
    <div class="content__container | container">
      <div class="not-found__content | content">
        <?php echo wpautop($content) ?>
      </div>

      <div class="not-found__button | cluster">
        <?php if($button): ?>
          <a href="<?php echo $button['url'] ?>" class="button">
            <?php echo $button['title'] ?>
          </a>
        <?php else: ?>
          <a href="<?php echo home_url() ?>" class="button">
            <?php esc_html_e('Back to home', 'codelibry') ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
