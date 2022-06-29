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
