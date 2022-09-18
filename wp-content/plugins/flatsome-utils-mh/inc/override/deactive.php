// ----------------------FLATSOME_UTILS
$flatsome_utils_path = ABSPATH . 'wp-content/plugins/flatsome-utils-mh/';
require $flatsome_utils_path . '/inc/helpers/helpers-flatsome_utils.php';
if (is_woocommerce_activated()) {
  require $flatsome_utils_path . '/inc/shortcodes/ux_products_flatsome_utils.php';
  require $flatsome_utils_path . '/inc/shortcodes/ux_product_categories_flatsome_utils.php';
}
require $flatsome_utils_path . '/inc/shortcodes/blog_posts_flatsome_utils.php';

add_action( 'ux_builder_setup', function () {
  global $flatsome_utils_path;
  require_once $flatsome_utils_path . '/inc/builder/shortcodes/blog_posts_flatsome_utils.php';
  require_once $flatsome_utils_path . '/inc/builder/shortcodes/ux_products_flatsome_utils.php';
  require_once $flatsome_utils_path . '/inc/builder/shortcodes/ux_product_categories_flatsome_utils.php';
  //require_once $flatsome_utils_path . '/inc/builder/shortcodes/tab_flatsome_utils.php';
  //require_once $flatsome_utils_path . '/inc/builder/shortcodes/tabgroup_flatsome_utils.php';
});