<?php

function rs_search_form($atts) { ?>

  <!-- Search Form -->
  <div class="search-products-form">
    <input class="search-products-form__search" type="search" id="live-product-input" placeholder="Search products..." autocomplete="off">
    <ul class="search-products-form__results | flow" id="live-product-results"></ul>
  </div>

  <!-- Search Form JavaScript -->
  <script>
  (function($){
      let debounceTimer;

      // hide results dropdown by default
      $('#live-product-results').hide();

      // show dropdown on input focus
      $('#live-product-input').on('focus', function(){
          if($('#live-product-results').children().length > 0) {
              $('#live-product-results').show();
          }
      });

      // hide dropdown on input unfocus
      $('#live-product-input').on('blur', function(){
          $('#live-product-results').hide();
      });

      $('#live-product-input').on('keyup', function(){
          const query = $(this).val().trim();
          const $results = $('#live-product-results');

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
                      query: query
                  },
                  beforeSend: function() {
                      $results.html('<li>Searching...</li>');
                  },
                  success: function(response) {
                      if (response && response.length) {
                          $results.html(response);
                      }

                      $('#live-product-input').focus();
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

add_shortcode('search-form', 'rs_search_form');
