<?php
			if( function_exists('acf_add_local_field_group') ):

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

        endif;