function HeaderCart() {
  jQuery(document).ready(function ($) {
    if (window.matchMedia('(max-width: 1024px)').matches) {
      return;
    }

    let hideTimeout;

    $(".header-cart")
      .on("mouseenter", function () {
        clearTimeout(hideTimeout);

        $(this)
          .find(".header-cart-mini")
          .stop(true, true)
          .fadeIn(200);
      })
      .on("mouseleave", function () {
        const $miniCart = $(this).find(".header-cart-mini");


        hideTimeout = setTimeout(function() {
          $miniCart.stop(true, true).fadeOut(200);
        }, 500); 
      });
  });
}

export default HeaderCart;