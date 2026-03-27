<?php

$search_variant = get('header__search-variant', $options = true) ?? 'form';
$include_cat = get('header__search-cat', $options = true) ?? 'no';

?>

<div class="header__search">

  <?php echo do_shortcode("[search-$search_variant cat_param='".$include_cat."']"); ?>

</div>
