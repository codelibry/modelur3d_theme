<?php

function rs_search_popup($atts) { ?>

  <?php 
    $params = shortcode_atts( 
      array(
        'show_cat' => 'yes'
      ), 
      $atts 
    ); 
  ?>

  <?php

    $cat_val  = isset($_GET['product_cat']) ? sanitize_text_field(wp_unslash($_GET['product_cat'])) : '';

    $terms = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'orderby'    => 'name',
            'parent'     => 0,
    ]);

      $print_options = function ($term, $prefix = '') use (&$print_options, $cat_val) {
      $selected = selected($cat_val, $term->slug, false);
      echo '<option value="' . esc_attr($term->slug) . '"' . $selected . '>' . esc_html($prefix . $term->name) . '</option>';

      $children = get_terms([
              'taxonomy'   => 'product_cat',
              'hide_empty' => false,
              'parent'     => $term->term_id,
              'orderby'    => 'name',
      ]);
      if (!is_wp_error($children) && $children) {
          foreach ($children as $child) {
              $print_options($child, $prefix . '— ');
          }
      }
    };

  ?>

  <!-- Search Popup Icon Link -->
  <a href="#popup-search-products">
    <?php echo get_inline_svg('search-icon'); ?>
    <span class="visually-hidden"><?php esc_html_e('Search Products', 'codelibry') ?></span>
  </a>

  <!-- Search Popup -->
  <dialog class="popup | box" id="popup-search-products">
    <button class="popup__close">
      <?php echo get_inline_svg('close-icon'); ?>
      <span class="visually-hidden"><?php esc_html_e('Close Popup', 'codelibry'); ?></span>
    </button>

    <div class="popup-search-products">
      <div class="popup-search-products__box">

        <?php if($params['show_cat'] == 'yes'): ?>
          <div class="search-form-categories">
            <select id="product-category-select" class="popup-search-products__select" name="product_cat" aria-label="<?php esc_attr_e('Select category'); ?>">
              <option value=""><?php esc_html_e('All categories'); ?></option>
              <?php
              if (!is_wp_error($terms) && $terms) {
                  foreach ($terms as $t) {
                      $print_options($t);
                  }
              }
              ?>
            </select>
            <svg class="caret" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 6L8.70711 9.29289C8.31658 9.68342 7.68342 9.68342 7.29289 9.29289L4 6" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        <?php endif; ?>
        
        <input class="popup-search-products__search" type="search" id="live-product-input" placeholder="Search products..." autocomplete="off">
      </div>
      <ul class="popup-search-products__results | flow" id="live-product-results"></ul>
    </div>
  </dialog>

  <!-- Search Popup JavaScript -->
  <script>
  (function($){
      let debounceTimer;

      $('#live-product-input').on('keyup', function(){
          const query = $(this).val().trim(); 
          const $results = $('#live-product-results');
          const category = $('.popup-search-products__select').find(":selected").val().trim();

          if(query.length < 2) {
            return;
          }

          clearTimeout(debounceTimer);

          debounceTimer = setTimeout(function() {
              $.ajax({
                  url: '<?php echo admin_url('admin-ajax.php'); ?>',
                  method: 'POST',
                  data: {
                      action: 'live_product_search',
                      query: query,
                      category: category
                  },
                  beforeSend: function() {
                      $results.html('<li>Searching...</li>');
                  },
                  success: function(response) {
                      if (response && response.length) {
                          $results.html(response);
                      }
                  },
                  error: function() {
                      $results.html('<li>Error loading results</li>');
                  }
              });
          }, 400); // ⏱ Delay 400ms after user stops typing
      });
  })(jQuery);
  </script>
<?php }

add_shortcode('search-popup', 'rs_search_popup');
