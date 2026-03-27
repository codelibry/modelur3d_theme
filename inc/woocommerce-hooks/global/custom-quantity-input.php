<?php

/*
 * Add WooCommerce Quantity Plus and Minus buttons
 */
add_action( 'woocommerce_before_quantity_input_field', function() { ?>
  <button type="button" class="minus">-</button>
<?php });

add_action( 'woocommerce_after_quantity_input_field', function(){ ?>
  <button type="button" class="plus">+</button>
<?php });

add_action( 'wp_footer', function() { ?>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      $('body').on( 'click', 'button.plus, button.minus', function() {
        var qty = $( this ).closest( '.quantity' ).find( '.qty' );
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr( 'max' ));
        var min = parseFloat(qty.attr( 'min' ));
        var step = parseFloat(qty.attr( 'step' ));

        if ( $( this ).is( '.plus' ) ) {
          if ( max && ( max <= val ) ) {
            qty.val( max );
          }
          else {
            qty.val( val + step );
          }
        }
        else {
          if ( min && ( min >= val ) ) {
            qty.val( min );
          }
          else if ( val > 1 ) {
            qty.val( val - step );
          }
        }

        qty.trigger('change');
      });
    });
  </script>
<?php });
