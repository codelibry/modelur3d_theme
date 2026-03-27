<?php
/**
 * Get the URL of an image in the 'assets/images' folder.
 *
 * @param   string  $image_name The name of the image file, including the extension.
 * @return  string  The full URL to the image.
 *
 * Usage:
 * <img src="<?php echo get_image_src('image-name.png') ?>" />
 */
function get_image_src(string $image_name): string {
  return get_template_directory_uri() . '/assets/images/' . $image_name;
}
