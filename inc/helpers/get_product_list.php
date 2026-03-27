<?php

function get_product_list($option, $products = []) {

  if($option === 'top-rated') {
    return get_top_rated_products();
  }

  if($option === 'best-selling') {
    return get_best_selling_products();
  }

  if($option === 'choose-manually') {
    return $products;
  }

}
