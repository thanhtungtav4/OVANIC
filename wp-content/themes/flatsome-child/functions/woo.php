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
    echo '<div class="item item-made">Xuất xứ: &nbsp; <span>'. $made .'</span> </div>';
   }
  do_action( 'woocommerce_rating_custome' );
  echo '</div>';
  }
};
add_action('woocommerce_single_title_module', 'add_brand_product_singer');


// show thuong hieu
function show_info(){
  global $post;
  global $product;
  $brand = get_the_terms( $post->ID , 'thuong-hieu' );
  $made = array_shift(woocommerce_get_product_terms($post->ID, 'pa_xuat-xu', 'names'));
  $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
  $price_save =  $product->regular_price - $product->sale_price ;
  if(!empty($brand[0]->name)){
    echo '<div>Thương hiệu:&nbsp;<a href='. $brand[0]->slug .'>  ' . $brand[0]->name .' </a></div>';
  }
  if(!empty($made)){
    echo '<div>Xuất xứ: &nbsp; <span>'. $made .'</span> </div>';
   }
    echo '<div>Giá: &nbsp;' . number_format($product->get_sale_price()) .'<sup>đ<sup> </span> </div>';
    woocommerce_simple_add_to_cart();
};
add_action('get_brand_name', 'show_info');
// show thuong hieu
//
// add text sản phẩm bán chạy ttl
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
add_action( 'woocommerce_single_title_module', 'woocommerce_template_single_title_custome', 5);
// !add text sản phẩm bán chạy ttl

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

//Move rating
add_action('woocommerce_rating_custome', 'single_rating_display');
function single_rating_display(){
  woocommerce_template_single_rating();
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
//Move rating
//Move of UP-Sells in page detail
add_action('woocommerce_upsell_display_custome', 'upsell_display');
function upsell_display(){
  woocommerce_upsell_display();
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
//Move of UP-Sells in page detail
//Move excerpt
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 45 );
//Move excerpt
/***
 * Add quickbuy button go to cart after click
 */
add_action('woocommerce_after_add_to_cart_button','devvn_quickbuy_after_addtocart_button');
function devvn_quickbuy_after_addtocart_button(){
   global $product;
   ?>
   <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt" id="buy_now_button">
       <?php _e('Mua ngay', 'devvn'); ?>
   </button>
   <input type="hidden" name="is_buy_now" id="is_buy_now" value="0" />
   <script>
       jQuery(document).ready(function(){
           jQuery('body').on('click', '#buy_now_button', function(){
               if(jQuery(this).hasClass('disabled')) return;
               var thisParent = jQuery(this).closest('form.cart');
               jQuery('#is_buy_now', thisParent).val('1');
               thisParent.submit();
           });
       });
   </script>
   <?php
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url) {
   if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
       $redirect_url = wc_get_checkout_url();
   }
   return $redirect_url;
}
/***
 * !Add quickbuy button go to cart after click
 */

//Data Tab
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_tabs_display_custome', 'data_tabs_display');
function data_tabs_display(){
  woocommerce_output_product_data_tabs();
}
//Data Tab