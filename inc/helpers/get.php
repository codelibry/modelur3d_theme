<?php

/*
 * Unique funciton to get some meta value
 */

function get(string $field, bool $options = false): mixed {

  // Get ACF Option
  if(function_exists('get_field') && $options === true) {
    return get_field($field, 'option') ? get_field($field, 'option') : null;
  }

  // Get ACF Field
  if(function_exists('get_field') && $options === false) {
    return get_field($field) ? get_field($field) : null;
  }


  return null;

}
