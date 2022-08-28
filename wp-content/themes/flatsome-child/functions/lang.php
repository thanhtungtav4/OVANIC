<?php
function my_custom_translations( $strings ) {
  $text = array(
  'Quick View' => 'Xem nhanh',
  'SHOPPING CART' => 'Giỏ hàng',
  'CHECKOUT DETAILS' => 'Thanh toán',
  'ORDER COMPLETE' => 'Hoàn thành',
  'Accept' => 'Chấp nhận',
  'Add to cart' => 'Cho vào giỏ',
  'Thêm vào giỏ hàng' => 'Cho vào giỏ',
  'Related products' => 'Sản phẩm tương tự',
  'Description' => 'Thông tin chi tiết',
  'Additional information' =>'Thông tin bổ sung',
  'Reviews' => 'Đánh giá',
  'Save' => 'Tiết kiệm',
  'This Product' =>'Sản phẩm chính',
  'View more' => 'Xem thêm',
  'by' => 'Bởi',
  'Continue reading' => 'Đọc tiếp',
  'Leave a comment' => 'Để lại bình luận',
  'Posted in' => 'Đã đăng trong',
  ' by ' => 'bởi',
  'Posted on' => 'Cập nhật lúc'
  );
  $strings = str_ireplace( array_keys( $text ), $text, $strings );
  return $strings;
  }
  add_filter( 'gettext', 'my_custom_translations', 20 );