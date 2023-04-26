<?php
//https://stackoverflow.com/questions/39063958/woocommerce-action-hooks-and-overriding-templates
function add_brand_product_singer() {
  $brand = get_the_terms(get_the_ID(), 'thuong-hieu');
  $product = wc_get_product(get_the_ID());
  $made = wc_get_product_terms(get_the_ID(), 'pa_xuat-xu', array('fields' => 'names'));

  if (!empty($brand)) {
      echo '<div class="brand-block">';
      echo '<div class="item item-brand">Thương hiệu:&nbsp;<a href="' . get_term_link($brand[0]) . '">' . $brand[0]->name . '</a></div>';

      if (!empty($product->get_sku())) {
          echo '<div class="item item-sku">Mã sản phẩm:&nbsp;<span>' . $product->get_sku() . '</span></div>';
      }

      if (!empty($made[0])) {
          echo '<div class="item item-made">Xuất xứ:&nbsp;<span>' . $made[0] . '</span></div>';
      }

      do_action('woocommerce_rating_custome');
      echo '</div>';
  }
}
add_action('woocommerce_single_title_module', 'add_brand_product_singer');


function show_info() {
  global $product;

  $brand = get_the_terms(get_the_ID(), 'thuong-hieu');
  $made = wc_get_product_terms(get_the_ID(), 'pa_xuat-xu', array('fields' => 'names'));
  $price = $product->get_sale_price() ? wc_price($product->get_sale_price()) : wc_price($product->get_regular_price());

  if ($product->is_on_sale()) {
      $percentage = round(($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price() * 100);
      $price_save = $product->get_regular_price() - $product->get_sale_price();
      $f_price_save = number_format($product->get_regular_price());
  }

  if (!empty($brand)) {
      echo '<div>Thương hiệu:&nbsp;<a href="' . get_term_link($brand[0]) . '">' . $brand[0]->name . '</a></div>';
  }

  if (!empty($made[0])) {
      echo '<div>Xuất xứ:&nbsp;<span>' . $made[0] . '</span></div>';
  }

  echo '<div class="nt-price">Giá:&nbsp;' . $price . '</div>';

  if (!empty($price_save)) {
      echo '<div class="price-on-sale" style="text-decoration: line-through;">' . $f_price_save . 'đ</div>';
  }

  if (function_exists('get_field') && get_field('stop_selling') == true) {
      echo '<p class="m-status"><strong>Sản phẩm ngừng kinh doanh</strong></p>';
  } else {
      woocommerce_simple_add_to_cart();
  }
}
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
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 45 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_excerpt_tungnt', 'woocommerce_template_single_excerpt_show');
function woocommerce_template_single_excerpt_show(){
  woocommerce_template_single_excerpt();
}
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
//show acf option
add_action('woocommerce_single_product_summary', 'acf_get_info', 11);
function acf_get_info(){
  echo the_field('thong_tin_uu_dai', 'option');
}
//!show acf option
function remove_woo_relate_products(){
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
  //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
}

add_action('init', 'remove_woo_relate_products', 10);

add_action('woocommerce_cross_sell_tungnt', 'show_woocommerce_output_related_products', 20);
function show_woocommerce_output_related_products(){
  woocommerce_output_related_products();
}
// add to cart muti product
// ex ovanic.io/checkout?add-to-cart=product_id_1,product_id_2,product_id_3
function woocommerce_maybe_add_multiple_products_to_cart() {
  // Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
  if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
      return;
  }

  // Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
  remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

  $product_ids = explode( ',', $_REQUEST['add-to-cart'] );
  $count       = count( $product_ids );
  $number      = 0;

  foreach ( $product_ids as $product_id ) {
      if ( ++$number === $count ) {
          // Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
          $_REQUEST['add-to-cart'] = $product_id;

          return WC_Form_Handler::add_to_cart_action();
      }

      $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
      $was_added_to_cart = false;
      $adding_to_cart    = wc_get_product( $product_id );

      if ( ! $adding_to_cart ) {
          continue;
      }

      $add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->product_type, $adding_to_cart );

      /*
       * Sorry.. if you want non-simple products, you're on your own.
       *
       * Related: WooCommerce has set the following methods as private:
       * WC_Form_Handler::add_to_cart_handler_variable(),
       * WC_Form_Handler::add_to_cart_handler_grouped(),
       * WC_Form_Handler::add_to_cart_handler_simple()
       *
       * Why you gotta be like that WooCommerce?
       */
      if ( 'simple' !== $add_to_cart_handler ) {
          continue;
      }

      // For now, quantity applies to all products.. This could be changed easily enough, but I didn't need this feature.
      $quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
      $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

      if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
          wc_add_to_cart_message( array( $product_id => $quantity ), true );
      }
  }
  }
   // Fire before the WC_Form_Handler::add_to_cart_action callback.
add_action( 'wp_loaded',        'woocommerce_maybe_add_multiple_products_to_cart', 15 );

function filter_woocommerce_attribute_value( $value ) {
  return preg_replace( '#<a.*?>([^>]*)</a>#i', '$1', $value );
}
add_filter( 'woocommerce_attribute', 'filter_woocommerce_attribute_value', 99 );
