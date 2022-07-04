<?php
function change_city_to_dropdown( $fields ) {

  $city_args = wp_parse_args( array(
      'type' => 'select',
      'options' => array(
        '' => "Vui Lòng chọn Tỉnh / Thành Phố",
        "HANOI" => "Hà Nội",
        "HOCHIMINH" => "Hồ Chí Minh",
        "ANGIANG" => "An Giang",
        "BACGIANG" => "Bắc Giang",
        "BACKAN" => "Bắc Kạn",
        "BACLIEU" => "Bạc Liêu",
        "BACNINH" => "Bắc Ninh",
        "BARIAVUNGTAU" => "Bà Rịa - Vũng Tàu",
        "BENTRE" => "Bến Tre",
        "BINHDINH" => "Bình Định",
        "BINHDUONG" => "Bình Dương",
        "BINHPHUOC" => "Bình Phước",
        "BINHTHUAN" => "Bình Thuận",
        "CAMAU" => "Cà Mau",
        "CANTHO" => "Cần Thơ",
        "CAOBANG" => "Cao Bằng",
        "DAKLAK" => "Đắk Lắk",
        "DAKNONG" => "Đắk Nông",
        "DANANG" => "Đà Nẵng",
        "DIENBIEN" => "Điện Biên",
        "DONGNAI" => "Đồng Nai",
        "DONGTHAP" => "Đồng Tháp",
        "GIALAI" => "Gia Lai",
        "HAGIANG" => "Hà Giang",
        "HAIDUONG" => "Hải Dương",
        "HAIPHONG" => "Hải Phòng",
        "HANAM" => "Hà Nam",
        "HATINH" => "Hà Tĩnh",
        "HAUGIANG" => "Hậu Giang",
        "HOABINH" => "Hòa Bình",
        "HUNGYEN" => "Hưng Yên",
        "KHANHHOA" => "Khánh Hòa",
        "KIENGIANG" => "Kiên Giang",
        "KONTUM" => "Kon Tum",
        "LAICHAU" => "Lai Châu",
        "LAMDONG" => "Lâm Đồng",
        "LANGSON" => "Lạng Sơn",
        "LAOCAI" => "Lào Cai",
        "LONGAN" => "Long An",
        "NAMDINH" => "Nam Định",
        "NGHEAN" => "Nghệ An",
        "NINHBINH" => "Ninh Bình",
        "NINHTHUAN" => "Ninh Thuận",
        "PHUTHO" => "Phú Thọ",
        "PHUYEN" => "Phú Yên",
        "QUANGBINH" => "Quảng Bình",
        "QUANGNAM" => "Quảng Nam",
        "QUANGNGAI" => "Quảng Ngãi",
        "QUANGNINH" => "Quảng Ninh",
        "QUANGTRI" => "Quảng Trị",
        "SOCTRANG" => "Sóc Trăng",
        "SONLA" => "Sơn La",
        "TAYNINH" => "Tây Ninh",
        "THAIBINH" => "Thái Bình",
        "THAINGUYEN" => "Thái Nguyên",
        "THANHHOA" => "Thanh Hóa",
        "THUATHIENHUE" => "Thừa Thiên Huế",
        "TIENGIANG" => "Tiền Giang",
        "TRAVINH" => "Trà Vinh",
        "TUYENQUANG" => "Tuyên Quang",
        "VINHLONG" => "Vĩnh Long",
        "VINHPHUC" => "Vĩnh Phúc",
        "YENBAI" => "Yên Bái",
      ),
  ), $fields['shipping']['shipping_state'] );

  $fields['shipping']['shipping_state'] = $city_args;
  $fields['billing']['shipping_state'] = $city_args;
  // Also change for billing field
  $fields['billing']['billing_city'] = array(
    'label' => __('District', 'devvn-vncheckout'),
    'required' => true,
    'type' => 'select',
    'class' => array('form-row-last'),
    'placeholder' => _x('Select District', 'placeholder', 'devvn-vncheckout'),
    'options' => array(
        '' => ''
    ),
    'priority' => 40
  );
  return $fields;

}

add_filter( 'woocommerce_checkout_fields', 'change_city_to_dropdown' );