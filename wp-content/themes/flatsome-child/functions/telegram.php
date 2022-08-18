<?php
/***
 * send noti if new order
 * https://www.shellhacks.com/telegram-api-send-message-personal-notification-bot/
 */
add_action('woocommerce_checkout_order_processed', 'notfi_telegram');
function notfi_telegram($order_id) {
  if(!$order_id) return;
  $order = wc_get_order($order_id);
  $order_data = $order->get_data();
  $first_name = $order_data['billing']['first_name'];
  $last_name = $order_data['billing']['last_name'];
  $phone = $order_data['billing']['phone'];
  $email = $order_data['billing']['email'];
  $msg = "<b>Đơn hàng mới </b>: Đơn hàng số [$order_id]  -  <b>Từ khách Hàng </b>: $last_name $first_name - $phone - $email";
  $botToken= '5440381056:AAGG0St5-y8cVBItKBHl2JHAAqu9pVbqDFY';
  $website = "https://api.telegram.org/bot".$botToken;
  $chatId = '-737404282';
  $params=[
      'chat_id'=>$chatId,
      'text'=>$msg,
      'parse_mode'=>'html',
      'type'=>'group'
  ];
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}
////////////////////
// is singer product send submit contact
////////////////////

// add ajax submit form
function ajax_contact_javascript() {
  if (is_product ()) {
    ?>
        <script type="text/javascript">
          jQuery( document ).ready( function( $ ) {
              "use strict";
              /**
               * The file is enqueued from inc/admin/class-admin.php.
              */
              $( '#product-contact-form' ).submit( function( event ) {

                  event.preventDefault(); // Prevent the default form submit.

                  // serialize the form data
                  var ajax_form_data = $("#product-contact-form").serialize();

                  //add our own ajax check as X-Requested-With is not always reliable
                  ajax_form_data = ajax_form_data+'&ajaxrequest=true&submit=Submit+Form';

                  $.ajax({
                      url:    '/wp-admin/admin-ajax.php', // domain/wp-admin/admin-ajax.php
                      type:   'post',
                      data:   ajax_form_data,
                      action: 'contact_telegram_hook'
                  })

                  .done( function( response ) { // response from the PHP action
                      $(" #nds_form_feedback ").html( "The request was successful");
                  })

                  // something went wrong
                  .fail( function() {
                      $(" #nds_form_feedback ").html( "Something went wrong." );
                  })

                  // after all this time?
                  .always( function() {
                      event.target.reset();
                  });
              });
            });
        </script>
    <?php
  }
}
add_action('wp_footer', 'ajax_contact_javascript');
// control request submit to function
add_action("wp_ajax_contact_telegram_hook", "contact_telegram");
add_action("wp_ajax_nopriv_contact_telegram_hook", "contact_telegram");
function contact_telegram(){
  if(!empty($_POST['ajaxrequest'])){
    $fullname = $_POST['fullname'] ? $_POST['fullname'] : null;
    $phone = $_POST['numberphone'] ? $_POST['numberphone'] : null;
    $product_title = $_POST['product_title'] ? $_POST['product_title'] : null;
    // in send telegram
    $msg = "<b>Yêu cầu tư vấn </b>: Từ khách hàng [$fullname]\n <b>Có số điện thoại </b>: [$phone]\n<b>Cho sản phẩm : </b> [$product_title] ";
    $botToken= '5440381056:AAGG0St5-y8cVBItKBHl2JHAAqu9pVbqDFY';
    $website = "https://api.telegram.org/bot".$botToken;
    $chatId = '-737404282';
    $params=[
        'chat_id'=>$chatId,
        'text'=>$msg,
        'parse_mode'=>'html',
        'type'=>'group'
    ];
    $ch = curl_init($website . '/sendMessage');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    // !in send telegram
  }

}
