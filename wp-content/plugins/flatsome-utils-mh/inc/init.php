<?php
// ----------------------FLATSOME_UTILS
$flatsome_utils_path = ABSPATH . 'wp-content/plugins/flatsome-utils-mh/';
require __DIR__ . '/helpers/helpers-flatsome_utils.php';
if (class_exists( 'WooCommerce' ) ) {
  require __DIR__ . '/shortcodes/ux_products_flatsome_utils.php';
  require __DIR__ . '/shortcodes/ux_product_categories_flatsome_utils.php';
}
require __DIR__ . '/shortcodes/blog_posts_flatsome_utils.php';
require __DIR__ . '/shortcodes/tabs_flatsome_utils.php';


$shortcodes = FSUT_getDirContents(FLATSOME_UTILS_MH_PATH . '/inc/shortcodes/');
foreach ($shortcodes as $key => $value) {
  if(strpos($value, 'custom_') !== false)
      require_once $value;

}


add_action( 'ux_builder_setup', function () {
  global $flatsome_utils_path;
  require_once __DIR__ . '/builder/shortcodes/blog_posts_flatsome_utils.php';
  require_once __DIR__ . '/builder/shortcodes/ux_products_flatsome_utils.php';
  require_once __DIR__ . '/builder/shortcodes/ux_product_categories_flatsome_utils.php';
  //require_once $flatsome_utils_path . '/inc/builder/shortcodes/tab_flatsome_utils.php';
  require_once __DIR__ .  '/builder/shortcodes/tabgroup_flatsome_utils.php';

  $builders = FSUT_getDirContents(FLATSOME_UTILS_MH_PATH . '/inc/builder/shortcodes/');
  foreach ($builders as $key => $value) {
    if(strpos($value, 'custom_') !== false)
      require_once $value;
  }
});