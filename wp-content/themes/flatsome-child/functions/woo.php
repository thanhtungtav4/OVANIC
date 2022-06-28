<?php
//https://stackoverflow.com/questions/39063958/woocommerce-action-hooks-and-overriding-templates
function add_brand_product_singer() {
  global $post;
  $brand = get_the_terms( $post->ID , array( 'thuong-hieu') );
  $product = new WC_Product($post->ID);
  $made = array_shift(woocommerce_get_product_terms($post->ID, 'pa_xuat-xu', 'names'));
  if(!empty($brand[0]->name)){
   echo '<div class="brand-block">';
   echo '<div class="item item-brand">Thương hiệu:&nbsp;<a href='. $brand[0]->slug .'>  ' . $brand[0]->name .' </a></div>';
   if(!empty($product->get_sku())){
    echo '<div class="item item-sku">Mã sản phẩm:&nbsp; <span>'. $product->get_sku() .'</span> </div>';
   }
   if(!empty($made)){
    echo '<div class="item item-made">Xuất xứ thương hiệu: '. $made .' </div>';
   }
   echo '</div>';
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



// add text sản phẩm bán chạy
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
function woocommerce_template_single_title_custome() {
  global $post;
  if (function_exists('get_field')){
  if(get_field('is_product_top_selling') == true){
    echo '<h1 class="product-title product_title entry-title">' . get_the_title() . '<span class="m-topsale"> Bán Chạy</span></h1>';
  }
  else{
    echo '<h1 class="product-title product_title entry-title">' . get_the_title() . '</h1>';
  }
}};
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_custome', 5);
// !sản phẩm bán chạy

//Move of UP-Sells in page detail
add_action('woocommerce_upsell_display_custome', 'upsell_display');
function upsell_display(){
  woocommerce_upsell_display();
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
//Move of UP-Sells in page detail
