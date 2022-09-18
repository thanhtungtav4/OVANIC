<?php

// Shortcode to display a single product
$repeater_columns = '4';
$repeater_type = 'slider';
$repeater_col_spacing = 'small';

$repeater_posts = 'products';
$repeater_post_type = 'product';
$repeater_post_cat = 'product_cat';

$options = array(
'style_options' => array(
    'type' => 'group',
    'heading' => __( 'Style' ),
    'options' => array(
         'style' => array(
            'type' => 'select',
            'heading' => __( 'Style' ),
            'default' => 'default',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/box-layouts.php' )
        )
    ),
),
'layout_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/repeater-options.php' ),
'layout_options_slider' => require( get_template_directory() . '/inc/builder/shortcodes/commons/repeater-slider.php' ),
'box_options' => array(
	'type'    => 'group',
	'heading' => __( 'Box' ),
	'options' => array(
		'show_cat' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Category' ),
			'default' => 'true',
		),
		'show_title' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Title' ),
			'default' => 'true',
		),
		'show_rating' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Rating' ),
			'default' => 'true',
		),
		'show_price' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Price' ),
			'default' => 'true',
		),
		'show_add_to_cart' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Add To Cart' ),
			'default' => 'true',
		),
		'show_quick_view' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Quick View' ),
			'default' => 'true',
		),
		'equalize_box' => array(
			'type'    => 'checkbox',
			'heading' => __( 'Equalize Items' ),
			'default' => 'false',
		),
        'flatsome_ultils_mh_pagination' => array(
            'type'    => 'checkbox',
            'heading' => __( 'Phân trang' ),
            'default' => 'false',
        ),
        'flatsome_ultils_mh_slide_2_row' => [
            'type' => 'slider',
            'heading' => __( 'Số hàng hiển thị(Chỉ áp dụng cho dạng Slide)' ),
            'default' => '1',
            'max' => '5',
            'min' => '1',
        ],
        'flatsome_ultils_mh_pagination_loadmore' => array(
            'type'    => 'checkbox',
            'heading' => __( 'Dạng nút tải thêm (Chỉ áp dụng cho dạng Row)' ),
            'default' => 'false',
        ),
        'flatsome_ultils_mh_pagination_loadmore_label' => array(
            'type'    => 'textfield',
            'heading' => __( 'Nhãn nút tải thêm' ),
            'default' => '',
        ),
	),
),

'post_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/repeater-posts.php' ),
'filter_posts' => array(
    'type' => 'group',
    'heading' => __( 'Filter Posts' ),
    'conditions' => 'ids == ""',
    'options' => array(
         'orderby' => array(
            'type' => 'select',
            'heading' => __( 'Order By' ),
            'default' => 'normal',
            'options' => array(
                'normal' => 'Normal',
                'title' => 'Title',
                'sales' => 'Sales',
                'rand' => 'Random',
                'date' => 'Date'
            )
        ),
        'order' => array(
            'type' => 'select',
            'heading' => __( 'Order' ),
            'default' => 'desc',
            'options' => array(
                'asc' => 'ASC',
                'desc' => 'DESC',
            )
        ),
        'show' => array(
            'type' => 'select',
            'heading' => __( 'Show' ),
            'default' => '',
            'options' => array(
                '' => 'All',
                'featured' => 'Featured',
                'onsale' => 'On Sale',
            )
        ),
         'out_of_stock' => array(
	         'type'    => 'select',
	         'heading' => __( 'Out Of Stock' ),
	         'default' => '',
	         'options' => array(
		         ''        => 'Include',
		         'exclude' => 'Exclude',
	         ),
         ),
    )
)
);

$box_styles = require( get_template_directory() . '/inc/builder/shortcodes/commons/box-styles.php' );
$options = array_merge($options, $box_styles);

$options['image_options']['conditions'] = 'style !== "default"';
$options['text_options']['conditions'] = 'style !== "default"';
$options['layout_options']['options']['depth']['conditions'] = 'style !== "default"';
$options['layout_options']['options']['depth_hover']['conditions'] = 'style !== "default"';

$options['post_options']['options']['tags'] = array(
  'type' => 'select',
  'heading' => 'Tag',
  'conditions' => 'ids == ""',
  'default' => '',
  'config' => array(
      'placeholder' => 'Select...',
      'termSelect' => array(
          'post_type' => 'product',
          'taxonomies' => 'product_tag',
      ),
  )
);

add_ux_builder_shortcode( 'ux_products_flatsome_utils', array(
    'name' => 'Products Flatsome Utils',
    'category' => __( 'Shop' ),
    'priority' => 1,
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'products' ),
    'presets' => array(
            array(
                'name' => __( 'Default' ),
                'content' => '[ux_products_flatsome_utils]'
            ),
            array(
                'name' => __( 'On Sale' ),
                'content' => '[ux_products_flatsome_utils orderby="sales" show="onsale"]'
            ),
            array(
                'name' => __( 'Featured Products' ),
                'content' => '[ux_products_flatsome_utils show="featured"]'
            ),
             array(
                'name' => __( 'Best Selling' ),
                'content' => '[ux_products_flatsome_utils orderby="sales"]'
            ),
            array(
                'name' => __( 'Lookbook Style' ),
                'content' => '[ux_products_flatsome_utils style="shade" slider_nav_style="circle" col_spacing="normal" depth="1" depth_hover="5"  image_height="200%" image_size="medium" image_hover="overlay-add" image_hover_alt="zoom-long" text_size="large" text_hover="hover-slide"]'
            ),
            array(
                'name' => __( 'Lookbook Style 2' ),
                'content' => '[ux_products_flatsome_utils style="overlay" slider_nav_style="circle" width="full-width" col_spacing="collapse" columns="6"  orderby="rand" image_height="200%" image_size="medium" image_overlay="rgba(0, 0, 0, 0.58)" image_hover="overlay-add" image_hover_alt="zoom-long" text_pos="middle" text_size="large" text_hover="zoom-in"]'
            ),array(
                'name' => __( 'Lookbook Style 3' ),
                'content' => '[ux_products_flatsome_utils style="overlay" image_height="169%" image_size="medium" image_overlay="rgba(0, 0, 0, 0.67)" image_hover="color" image_hover_alt="overlay-remove-50" text_size="large"]'
            ), array(
                'name' => __( 'Masonery Style' ),
                'content' => '[ux_products_flatsome_utils style="normal" type="masonry" depth="1" depth_hover="5" text_align="left"]'
            ), array(
                'name' => __( 'Grid Style' ),
                'content' => '[ux_products_flatsome_utils style="shade" type="grid" grid_height="650px" products="4" orderby="sales" show="featured" image_overlay="rgba(0, 0, 0, 0.19)" image_hover="zoom" image_hover_alt="glow" text_align="left" text_size="large"]'
       ),
    ),
    'options' => $options
) );
