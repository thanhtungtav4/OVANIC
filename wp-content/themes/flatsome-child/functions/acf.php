<?php
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
  acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Detail Product',
		'menu_title'	=> 'Theme Product',
		'parent_slug'	=> 'theme-general-settings',
	));

}
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_62a6ef8cb1bec',
    'title' => 'Insert Headers and Footers',
    'fields' => array(
      array(
        'key' => 'field_62a6f0317cd8d',
        'label' => 'Insert Headers',
        'name' => 'insert_headers',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_62a6f0567cd8e',
        'label' => 'Insert Footers',
        'name' => 'insert_footers',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'theme-general-settings',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'permalink',
      1 => 'the_content',
      2 => 'excerpt',
      3 => 'discussion',
      4 => 'comments',
      5 => 'revisions',
      6 => 'slug',
      7 => 'author',
      8 => 'format',
      9 => 'page_attributes',
      10 => 'featured_image',
      11 => 'categories',
      12 => 'tags',
      13 => 'send-trackbacks',
    ),
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

  acf_add_local_field_group(array(
    'key' => 'group_62a6f19c21d00',
    'title' => 'Insert Schemas',
    'fields' => array(
      array(
        'key' => 'field_62a6f1f867341',
        'label' => 'Insert Schema',
        'name' => 'insert_schema',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
      ),
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'send-trackbacks',
    ),
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

  acf_add_local_field_group(array(
    'key' => 'group_62a006f5be468',
    'title' => 'Ngừng Kinh Doanh',
    'fields' => array(
      array(
        'key' => 'field_62a007071ebbc',
        'label' => 'Stop Selling',
        'name' => 'stop_selling',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 0,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'product',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  acf_add_local_field_group(array(
    'key' => 'group_62aab5628ec8a',
    'title' => 'Post Suggest',
    'fields' => array(
      array(
        'key' => 'field_62aab562a9c3c',
        'label' => 'List Post Suggest',
        'name' => 'list_post_suggest',
        'type' => 'relationship',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'post',
        ),
        'taxonomy' => '',
        'filters' => array(
          0 => 'search',
          1 => 'post_type',
          2 => 'taxonomy',
        ),
        'elements' => array(
          0 => 'featured_image',
        ),
        'min' => '',
        'max' => '',
        'return_format' => 'id',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'send-trackbacks',
    ),
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

  acf_add_local_field_group(array(
    'key' => 'group_62b16ac9b0b76',
    'title' => 'Bán Chạy',
    'fields' => array(
      array(
        'key' => 'field_62b16ac9b58ab',
        'label' => 'Sản phẩm bán chạy',
        'name' => 'is_product_top_selling',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 0,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'product',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

  acf_add_local_field_group(array(
    'key' => 'group_62be56c2085a2',
    'title' => 'Post increase purchase rate',
    'fields' => array(
      array(
        'key' => 'field_62be5726baa58',
        'label' => 'Post increase purchase rate',
        'name' => 'post_increase_purchase_rate',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'row',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_62be5768baa59',
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_62be57bbbaa5a',
            'label' => 'Url',
            'name' => 'url',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'product',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  acf_add_local_field_group(array(
    'key' => 'group_62d7984921672',
    'title' => 'Add Content Brand/Category Product',
    'fields' => array(
      array(
        'key' => 'field_62d798df6e086',
        'label' => 'Bottom Content',
        'name' => 'bottom_content',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'thuong-hieu',
        ),
      ),
      array(
        array(
          'param' => 'taxonomy',
          'operator' => '==',
          'value' => 'product_cat',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  acf_add_local_field_group(array(
    'key' => 'group_63043092cc07d',
    'title' => 'Tham vấn y khoa',
    'fields' => array(
      array(
        'key' => 'field_630430a2298c7',
        'label' => 'Tham vấn y khoa bởi',
        'name' => 'tham_van_y_khoa',
        'type' => 'user',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'role' => '',
        'allow_null' => 0,
        'multiple' => 1,
        'return_format' => 'id',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

endif;
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_62eb3ad25fc07',
    'title' => 'Thông tin cam kết chi tiết sản phẩm',
    'fields' => array(
      array(
        'key' => 'field_62eb3b0b0e4f3',
        'label' => 'Cam kết sản phẩm',
        'name' => 'cam_ket_san_pham',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'Sản phẩm này là hàng chính hãng 100%. Sản phẩm từ Ovanic luôn dán tem của Ovanic bên ngoài, đầy đủ hộp và thiệp cảm ơn từ Ovanic. Quý khách vui lòng kiểm tra sản phẩm trước khi nhận.',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_62eb3f3d1781a',
        'label' => 'Thông tin ưu đãi',
        'name' => 'thong_tin_uu_dai',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '<div class="promotion-sale">
    <div class="d-flex align-items-center">
      <img class="skip-lazy" src="https://ovanic.vn/wp-content/themes/flatsome-child/assets/images/icon-login.svg" alt="">
      <p>Đặt mua sản phẩm tại <strong>Ovanic</strong> ngay để nhận được các ưu đãi hấp dẫn nhất chưa từng có </p>
    </div>
    <ul class="list-privacy">
      <li>Miễn phí giao hàng cho đơn hàng từ <b>1.000.000 VNĐ</b> tới mọi tỉnh thành </li>
      <li>Miễn phí ship nội thành trong bán kính 5km với đơn hàng từ <b>250.000 VNĐ</b>
      </li>
      <li>Quà tặng hấp dẫn lên tới <b>1.000.000 VNĐ</b>
      </li>
      <li>Tiết kiệm lên tới <b>50%</b> khi mua các sản phẩm combo </li>
    </ul>
  </div>',
        'tabs' => 'text',
        'media_upload' => 0,
        'toolbar' => 'full',
        'delay' => 0,
      ),
      array(
        'key' => 'field_62eb60a732c0a',
        'label' => 'Cam kết Dịch Vụ',
        'name' => 'cam_ket_dich_vu',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '<div class="shop_info">
    <span class="shop_info_ttl"> Cam Kết của Ovanic </span>
    <ul>
      <li>
         <span class="title">Cam kết chính hãng</span>
         <p> Hoàn tiền 200% nếu phát hiện hàng giả, hàng nhái.</p>
      </li>
      <li>
         <span class="title">Cam kết tư vấn đúng</span>
         <p> Chuyên gia tư vấn trực tiếp qua hotline/zalo: 0987.827.327</p>
      </li>
      <li>
         <span class="title">Cam kết bảo mật</span>
         <p>Tuyệt đối không chia sẻ thông tin khách hàng cho bên thứ 3.</p>
      </li>
    </ul>
  </div>',
        'tabs' => 'text',
        'media_upload' => 1,
        'toolbar' => 'full',
        'delay' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-theme-product',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  acf_add_local_field_group(array(
    'key' => 'group_630af818b5465',
    'title' => 'Insert schema Product',
    'fields' => array(
      array(
        'key' => 'field_630af828d32a1',
        'label' => 'insert schema product',
        'name' => 'insert_schema_product',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'product',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
  
  endif;
