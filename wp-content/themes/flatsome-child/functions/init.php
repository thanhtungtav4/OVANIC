<?php
/***
 * Disable Gutenberg with Code
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
/***
 * !Disable Gutenberg with Code
 */
/****
 * https://stackoverflow.com/questions/14396735/woocommerce-custom-price-range-in-url
 * https://gitlab.com/vncloudsco
 */
// Remove Wordpress Body Classes
add_filter('body_class','my_class_names');
function my_class_names($classes) {
    return array();
}