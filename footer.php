    <?php get_template_part('template-parts/footer/footer'); ?>

    <?php if(get('header__login-popup', $options = true)): ?>
      <?php get_template_part('template-parts/footer/auth-popups'); ?>
    <?php endif; ?>
    
    <?php wp_footer() ?>

    </div>
  </body>
</html> 
