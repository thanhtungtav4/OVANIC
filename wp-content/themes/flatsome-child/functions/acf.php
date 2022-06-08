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
              'type' => 'select',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'choices' => array(
                'true: True, false: False' => 'true: True, false: False',
              ),
              'default_value' => array(
              ),
              'allow_null' => 0,
              'multiple' => 1,
              'ui' => 1,
              'ajax' => 1,
              'return_format' => 'value',
              'placeholder' => '',
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