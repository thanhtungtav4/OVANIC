<?php
//https://stackoverflow.com/questions/39063958/woocommerce-action-hooks-and-overriding-templates
function add_brand_product_singer() {
  global $post;
  $brand = get_the_terms( $post->ID , array( 'thuong-hieu') );
  if(!empty($brand[0]->name)){
   echo '<p class="m-brand">Thương Hiệu:  <a href='. $brand[0]->slug .'> '. $brand[0]->name .' </a></p>';
  }
};
add_action( 'woocommerce_single_product_summary', 'add_brand_product_singer', 6 );

// notselling product detail product is check
function shownotselling() {
  if (function_exists('get_field')){
    if(get_field('stop_selling') == true){
      echo '<p class="m-status"><strong>Sản phẩm ngừng kinh doanh</strong></p>';
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
}};
add_action( 'woocommerce_single_product_summary', 'shownotselling', 7 );
// !notselling product detail product is check

// notselling product is quick view
function hideCart() {
  global $post;
  if (function_exists('get_field')){
  if(get_field('stop_selling') == true){
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_shop_loop_item_title', 30 );
    echo '<p class="m-status"><strong>Sản phẩm ngừng kinh doanh</strong></p>';
  }
}};
add_action( 'woocommerce_simple_add_to_cart', 'hideCart', 6 );
// !notselling product is quick view

function add_noti(){
  global $post;
  if (function_exists('get_field')){
  if(get_field('stop_selling') == true){
   echo '<span class="badge-container absolute right top z-1">Hết Hàng</span>';
  }
}};
add_action( 'woocommerce_before_shop_loop_item', 'add_noti', 9 );

