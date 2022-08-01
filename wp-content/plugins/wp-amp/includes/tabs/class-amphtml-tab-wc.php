<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( ! class_exists( 'AMPHTML_Tab_Wc' ) ) {

    class AMPHTML_Tab_Wc extends AMPHTML_Tab_Abstract {

        public function get_sections() {
            return array(
                'wc_general'     => __( 'General', 'amphtml' ),
                'product'     => __( 'Product Page', 'amphtml' ),
                'shop'        => __( 'Shop Page', 'amphtml' ),
                'wc_archives' => __( 'Product Archives', 'amphtml' ),
                'cart'        => __( 'Cart', 'amphtml' ),
                'add_to_cart' => __( 'Add to Cart', 'amphtml' ),
            );
        }

        public function get_fields() {
            return array_merge( $this->get_add_to_cart_fields( 'add_to_cart' ), $this->get_cart_fields( 'cart' ), $this->get_wc_general_fields( 'wc_general' ), $this->get_product_fields( 'product' ), $this->get_shop_fields( 'shop' ), $this->get_archives_fields( 'wc_archives' ) );
        }

        public function get_product_fields( $section ) {
            $fields = array(
                array(
                    'id'                    => $section . '_breadcrumbs',
                    'title'                 => __( 'Breadcrumbs', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_breadcrumbs',
                        'section' => $section
                    ),
                    'template_name'         => 'breadcrumb',
                    'description'           => __( 'Show breadcrumbs', 'amphtml' )
                ),
                // Block original button
                array(
                    'id'                    => $section . '_original_btn_block',
                    'title'                 => __( 'Original Button', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_original_btn_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_original_btn_block',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_original_btn_block' ),
                    'template_name'         => 'original_btn_block',
                    'description'           => __( 'Show link to the original version of the product', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_original_btn_text',
                    'title'                 => '',
                    'default'               => __( 'View Original Version', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_original_btn_text',
                        'section' => $section
                    ),
                    'description'           => __( 'Button title', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_search_form',
                    'title'                 => __( 'Product Search Form', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_search_form',
                        'section' => $section
                    ),
                    'template_name'         => 'searchform',
                    'description'           => __( 'Enable search form. Needs SSL certificate for AMP validation.', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_image',
                    'title'                 => __( 'Image', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_image',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product image', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_title',
                    'title'                 => __( 'Title', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_title',
                        'section' => $section
                    ),
                    'template_name'         => 'title',
                    'description'           => 'Show product title',
                ),
                array(
                    'id'                    => $section . '_sku',
                    'title'                 => __( 'SKU', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_sku',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product SKU', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_rating',
                    'title'                 => __( 'Rating', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_rating',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product rating', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to_cart_block',
                    'title'                 => __( 'Add To Cart Block', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_add_to_cart_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_add_to_cart_block',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_add_to_cart_block' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_price',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'       => $section . '_price',
                        'disabled' => true,
                        'checked'  => true,
                        'section'  => $section
                    ),
                    'description'           => __( 'Show product price', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_stock_status',
                    'title'                 => __( 'Stock Status', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_stock_status',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product stock status', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_qty',
                    'title'                 => __( 'Quantity', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_qty',
                        'section' => $section
                    ),
                    'description'           => __( 'Show quantity option. Needs SSL certificate for AMP validation.', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_options',
                    'title'                 => __( 'Options', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_options',
                        'section' => $section
                    ),
                    'description'           => __( 'Show variable options. Needs SSL certificate for AMP validation.', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to',
                    'title'                 => __( 'Add To Cart', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'       => $section . '_add_to',
                        'disabled' => true,
                        'checked'  => true,
                        'section'  => $section
                    ),
                    'description'           => __( 'Show add to cart button', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_categories',
                    'title'                 => __( 'Categories', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_categories',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product categories', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_tags',
                    'title'                 => __( 'Tags', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_tags',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product tags', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_short_desc',
                    'title'                 => __( 'Short Description', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_short_desc',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product short description', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_social_share',
                    'title'                 => __( 'Social Share Buttons', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_social_share',
                        'section' => $section
                    ),
                    'description'           => __( 'Show social share buttons', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_description_block',
                    'title'                 => __( 'Content Block', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_description_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_description_block',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_description_block' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_desc',
                    'title'                 => __( 'Description', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_desc',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product description', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_attributes',
                    'title'                 => __( 'Attributes', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_attributes',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product attributes', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_reviews',
                    'title'                 => __( 'Reviews', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_reviews',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product reviews', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_related_products_block',
                    'title'                 => __( 'Related Products', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_related_products_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_related_products_block',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_related_products_block' ),
                    'description'           => __( 'Show related products', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_related_rating',
                    'title'                 => __( 'Rating', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_related_rating',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product rating', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_related_price',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_related_price',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product price', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_custom_html',
                    'title'                 => __( 'Custom HTML', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_textarea_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_custom_html',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
                    'template_name'         => 'custom_html',
                    'description'           => __( 'Plain html without inline styles allowed. ' . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )
                ),
            );

            $top_ad_block[] = array(
                'id'                    => $section . '_ad_top',
                'title'                 => __( 'Ad Block #1', 'amphtml' ),
                'default'               => 0,
                'section'               => $section,
                'display_callback'      => array( $this, 'display_checkbox_field' ),
                'display_callback_args' => array(
                    'id'      => $section . '_ad_top',
                    'section' => $section
                ),
                'description'           => __( 'Show ad block #1', 'amphtml' ),
            );

            $bottom_ad_block[] = array(
                'id'                    => $section . '_ad_bottom',
                'title'                 => __( 'Ad Block #2', 'amphtml' ),
                'default'               => 0,
                'section'               => $section,
                'display_callback'      => array( $this, 'display_checkbox_field' ),
                'display_callback_args' => array(
                    'id'      => $section . '_ad_bottom',
                    'section' => $section
                ),
                'description'           => __( 'Show ad block #2', 'amphtml' ),
            );

            $fields = array_merge( $top_ad_block, $fields, $bottom_ad_block );

            return apply_filters( 'amphtml_template_product_fields', $fields, $section, $this );
        }

        public function get_shop_fields( $section ) {
            return array(
                array(
                    'id'                    => $section . '_view',
                    'title'                 => __( 'View', 'amphtml' ),
                    'default'               => 'list',
                    'display_callback'      => array( $this, 'display_select' ),
                    'display_callback_args' => array(
                        'id'             => $section . '_view',
                        'class'          => 'unsortable',
                        'select_options' => array(
                            'list'   => 'List',
                            'list_2' => 'List 2',
                            'grid'   => 'Grid'
                        ),
                        'section'        => $section
                    ),
                    'section'               => $section
                ),
                array(
                    'id'                    => $section . '_breadcrumbs',
                    'title'                 => __( 'Breadcrumbs', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_breadcrumbs',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'template_name'         => 'breadcrumb',
                    'description'           => __( 'Show breadcrumbs', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_original_btn_text',
                    'title'                 => '',
                    'default'               => __( 'View Original Version' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_original_btn_text' ),
                    'description'           => __( 'Button title', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_original_btn_block',
                    'title'                 => __( 'Original Button', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_original_btn_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_original_btn_block',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_original_btn_block' ),
                    'template_name'         => 'original_btn_block',
                    'description'           => __( 'Show link to the original version of the page', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_search_form',
                    'title'                 => __( 'Product Search Form', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_search_form',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'template_name'         => 'searchform',
                    'description'           => __( 'Enable search form. Needs SSL certificate for AMP validation.', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_sort',
                    'title'                 => __( 'Sorting Block', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_sort' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_sort_block',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_sort' ),
                    'template_name'         => 'sort_block',
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_sort_block',
                    'title'                 => __( 'Sort', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_sort_block', 'section' => $section ),
                    'description'           => __( 'Show "Sorting Block"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_popularity',
                    'title'                 => __( 'Popularity', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_popularity', 'section' => $section ),
                    'description'           => __( 'Show "Sort by popularity"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_average_rating',
                    'title'                 => __( 'Average rating', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_average_rating', 'section' => $section ),
                    'description'           => __( 'Show "Sort by average rating"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_date',
                    'title'                 => __( 'Date', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_date', 'section' => $section ),
                    'description'           => __( 'Show "Sort by latest"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_price_asc',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price_asc', 'section' => $section ),
                    'description'           => __( 'Show "Sort by price: low to high"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_price_desc',
                    'title'                 => __( 'Price Desc', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price_desc', 'section' => $section ),
                    'description'           => __( 'Show "Sort by price: high to low"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_link_image',
                    'title'                 => __( 'Link Image', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_link_image',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Link product images', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_image',
                    'title'                 => __( 'Image', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_image', 'section' => $section ),
                    'description'           => __( 'Show product images', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_rating',
                    'title'                 => __( 'Rating', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_rating', 'section' => $section ),
                    'description'           => __( 'Show product rating', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_short_desc',
                    'title'                 => __( 'Short Description', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_short_desc', 'section' => $section ),
                    'template_name'         => 'wc_archives_short_desc',
                    'description'           => __( 'Show product short descriptions', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to_cart_block',
                    'title'                 => __( 'Add To Cart Block', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_shop_add_to_cart_block' ),
                    'display_callback_args' => array( 'id' => $section . '_add_to_cart_block', 'section' => $section ),
                    'sanitize_callback'     => array( $this, 'sanitize_shop_add_to_cart_block' ),
                    'template_name'         => 'add_to_cart_block',
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_price',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price', 'section' => $section ),
                    'description'           => __( 'Show product prices', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to_cart',
                    'title'                 => __( 'Add to Cart', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_add_to_cart', 'section' => $section ),
                    'description'           => __( 'Show "Add to Cart" button', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_custom_html',
                    'title'                 => __( 'Custom HTML', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_textarea_field' ),
                    'display_callback_args' => array( 'id' => $section . '_custom_html', 'section' => $section ),
                    'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
                    'template_name'         => 'custom_html',
                    'description'           => __( 'Plain html without inline styles allowed. ' . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )
                ),
            );
        }

        public function get_archives_fields( $section ) {
            return array(
                array(
                    'id'                    => $section . '_view',
                    'title'                 => __( 'View', 'amphtml' ),
                    'default'               => 'list',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_select' ),
                    'display_callback_args' => array(
                        'id'             => $section . '_view',
                        'class'          => 'unsortable',
                        'select_options' => array(
                            'list'   => 'List',
                            'list_2' => 'List 2',
                            'grid'   => 'Grid'
                        ),
                        'section'        => $section,
                    ),
                ),
                array(
                    'id'                    => $section . '_breadcrumbs',
                    'title'                 => __( 'Breadcrumbs', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_breadcrumbs',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'template_name'         => 'breadcrumb',
                    'description'           => __( 'Show breadcrumbs', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_search_form',
                    'title'                 => __( 'Product Search Form', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_search_form',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'template_name'         => 'searchform',
                    'description'           => __( 'Enable search form. Needs SSL certificate for AMP validation.', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_desc',
                    'title'                 => __( 'Description', 'amphtml' ),
                    'default'               => 1,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_desc',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'section'               => $section,
                    'description'           => __( 'Show description of archive page', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_original_btn_block',
                    'title'                 => __( 'Original Button', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_original_btn_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_original_btn_block',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_original_btn_block' ),
                    'template_name'         => 'original_btn_block',
                    'description'           => __( 'Show link to the original version of the page', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_original_btn_text',
                    'title'                 => '',
                    'default'               => __( 'View Original Version' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_original_btn_text' ),
                    'description'           => __( 'Button title', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_sort',
                    'title'                 => __( 'Sorting Block', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_sort' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_sort_block',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_sort' ),
                    'template_name'         => 'sort_block',
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_sort_block',
                    'title'                 => __( 'Sort', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_sort_block', 'section' => $section ),
                    'description'           => __( 'Show "Sorting Block"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_popularity',
                    'title'                 => __( 'Popularity', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_popularity', 'section' => $section ),
                    'description'           => __( 'Show "Sort by popularity"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_average_rating',
                    'title'                 => __( 'Average rating', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_average_rating', 'section' => $section ),
                    'description'           => __( 'Show "Sort by average rating"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_date',
                    'title'                 => __( 'Date', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_date', 'section' => $section ),
                    'description'           => __( 'Show "Sort by latest"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_price_asc',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price_asc', 'section' => $section ),
                    'description'           => __( 'Show "Sort by price: low to high"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_price_desc',
                    'title'                 => __( 'Price Desc', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price_desc', 'section' => $section ),
                    'description'           => __( 'Show "Sort by price: high to low"', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_link_image',
                    'title'                 => __( 'Link Image', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_link_image',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Link product images', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_image',
                    'title'                 => __( 'Image', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_image', 'section' => $section ),
                    'description'           => __( 'Show product images', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_rating',
                    'title'                 => __( 'Rating', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_rating', 'section' => $section ),
                    'description'           => __( 'Show product rating', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_short_desc',
                    'title'                 => __( 'Short Description', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => $section . '_short_desc', 'section' => $section ),
                    'description'           => __( 'Show product short descriptions', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to_cart_block',
                    'title'                 => __( 'Add To Cart Block', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_shop_add_to_cart_block' ),
                    'display_callback_args' => array( 'id' => $section . '_add_to_cart_block', 'section' => $section ),
                    'sanitize_callback'     => array( $this, 'sanitize_shop_add_to_cart_block' ),
                    'template_name'         => 'add_to_cart_block',
                    'description'           => '',
                ),
                array(
                    'id'                    => $section . '_price',
                    'title'                 => __( 'Price', 'amphtml' ),
                    'default'               => 1,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_price', 'section' => $section ),
                    'section'               => $section,
                    'description'           => __( 'Show product prices', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_add_to_cart',
                    'title'                 => __( 'Add to Cart', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_add_to_cart', 'section' => $section ),
                    'description'           => __( 'Show "Add to Cart" button', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_custom_html',
                    'title'                 => __( 'Custom HTML', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_textarea_field' ),
                    'display_callback_args' => array( 'id' => $section . '_custom_html', 'section' => $section ),
                    'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
                    'template_name'         => 'custom_html',
                    'description'           => __( 'Plain html without inline styles allowed. ' . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )
                ),
            );
        }

        public function get_cart_fields( $section ) {
            return array(
                array(
                    'id'                    => $section . '_enable',
                    'title'                 => __( 'Cart page amp', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_enable',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Enable cart amp. Needs SSL certificate for AMP validation.', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_breadcrumbs',
                    'title'                 => __( 'Breadcrumbs', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_breadcrumbs',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'template_name'         => 'breadcrumb',
                    'description'           => __( 'Show breadcrumbs', 'amphtml' )
                ),
                // Block original button
                array(
                    'id'                    => $section . '_original_btn_block',
                    'title'                 => __( 'Original Button', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_original_btn_block' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_original_btn_block',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'sanitize_callback'     => array( $this, 'sanitize_original_btn_block' ),
                    'template_name'         => 'original_btn_block',
                    'description'           => __( 'Show link to the original version of the cart', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_original_btn_text',
                    'title'                 => '',
                    'default'               => __( 'View Original Version', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, '' ),
                    'display_callback_args' => array( 'id' => $section . '_original_btn_text', 'section' => $section ),
                    'description'           => __( 'Button title', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_image',
                    'title'                 => __( 'Image', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => 'cart_image',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Show product image', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_coupon',
                    'title'                 => __( 'Coupon', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_coupon',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Show coupon', 'amphtml' ),
                ),
                array(
                    'id'                    => $section . '_update',
                    'title'                 => __( 'Update block', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_update',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Show quantity option and update button', 'amphtml' ),
                ),
            );
        }

        public function get_wc_general_fields( $section ) {
            return array(
                array(
                    'id'                    => $section . '_replace_shortcodes',
                    'title'                 => __( 'Replace WC Shortcodes', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array(
                        'id'      => $section . '_replace_shortcodes',
                        'class'   => 'unsortable',
                        'section' => $section
                    ),
                    'description'           => __( 'Enable for replace standart product cart to amp in wc shortcodes.', 'amphtml' )
                ),
            );
        }

        public function get_add_to_cart_fields( $section ) {
            return array(
                array(
                    'id'                    => $section . '_text',
                    'title'                 => __( 'Add to Cart Text', 'amphtml' ),
                    'default'               => __( 'Add To Cart', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => $section . '_text', 'section' => $section ),
                    'description'           => __( '"Add to Cart" button text', 'amphtml' )
                ),
                array(
                    'id'                    => $section . '_behav',
                    'title'                 => __( 'Add to Cart Behavior', 'amphtml' ),
                    'default'               => $section . '_ajax',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_add_to_cart_behav' ),
                    'display_callback_args' => array( 'id' => $section . '_behav', 'section' => $section ),
                    'description'           => __( '"Add to Cart" button click action', 'amphtml' ),
                ),
            );
        }

        /*
         * Add To Cart Section
         */

        public function display_add_to_cart_behav( $args ) {
            $section = $args[ 'section' ];
            ?>
            <select style="width: 28%" id="add_to_cart_behav"
                    name="<?php echo $this->options->get( $section . '_behav', 'name' ) ?>">
                <option value="add_to_cart_ajax" <?php selected( $this->options->get( $section . '_behav' ), 'add_to_cart_ajax' ) ?>>
                    <?php _e( 'Enable AJAX add to cart buttons', 'amphtml' ); ?>
                </option>
                <option value="add_to_cart" <?php selected( $this->options->get( $section . '_behav' ), 'add_to_cart' ) ?>>
                    <?php _e( 'Add to cart and redirect to product page', 'amphtml' ); ?>
                </option>
                <option
                    value="add_to_cart_cart" <?php selected( $this->options->get( $section . '_behav' ), 'add_to_cart_cart' ) ?>>
                        <?php _e( 'Add to cart and redirect to cart page', 'amphtml' ); ?>
                </option>
                <option
                    value="add_to_cart_checkout" <?php selected( $this->options->get( $section . '_behav' ), 'add_to_cart_checkout' ) ?>>
                        <?php _e( 'Add to cart and redirect to checkout page', 'amphtml' ); ?>
                </option>
                <option value="redirect" <?php selected( $this->options->get( $section . '_behav' ), 'redirect' ) ?>>
                    <?php _e( 'Redirect to product page', 'amphtml' ); ?>
                </option>
            </select>
            <p class="description"><?php esc_html_e( $this->options->get( $section . '_behav', 'description' ), 'amphtml' ) ?></p>
            <?php
        }

        public function display_add_to_cart_block( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_price' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_stock_status' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_qty' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_options' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_add_to' ) ); ?>
            </fieldset>
            <?php
        }

        public function display_description_block( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_desc' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_attributes' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_reviews' ) ); ?>

            </fieldset>
            <?php
        }

        public function display_related_products_block( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php
                $this->display_checkbox_field( array( 'id' => $section . '_related_products_block' ) );
                if ( $this->options->get( $section . '_related_products_block' ) ) {
                    $this->display_checkbox_field( array( 'id' => $section . '_related_rating' ) );
                    $this->display_checkbox_field( array( 'id' => $section . '_related_price' ) );
                }
                ?>
            </fieldset>
            <?php
        }

        public function display_shop_add_to_cart_block( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_price' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_add_to_cart' ) ); ?>
            </fieldset>
            <?php
        }

        public function display_original_btn_block( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_original_btn_block' ) ); ?>
                <br>
                <?php $this->display_text_field( array( 'id' => $section . '_original_btn_text' ) ); ?>
            </fieldset>
            <?php
        }

        public function display_sort( $args ) {
            $section = $args[ 'section' ];
            ?>
            <fieldset>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_sort_block' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_popularity' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_average_rating' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_date' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_price_asc' ) ); ?>
                <?php $this->display_checkbox_field( array( 'id' => $section . '_price_desc' ) ); ?>            
            </fieldset>
            <?php
        }

        public function sanitize_add_to_cart_block() {
            $section = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_price',
                $section . '_stock_status',
                $section . '_qty',
                $section . '_options',
                $section . '_add_to'
            ) );

            return 1;
        }

        public function sanitize_description_block() {
            $section = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_desc',
                $section . '_attributes',
                $section . '_reviews'
            ) );

            return 1;
        }

        public function sanitize_related_products_block() {
            $section    = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_related_rating',
                $section . '_related_price',
            ) );
            $block_name = $this->options->get( $section . '_related_products_block', 'name' );

            return isset( $_POST[ $block_name ] ) ? sanitize_text_field( $_POST[ $block_name ] ) : '';
        }

        public function sanitize_shop_add_to_cart_block() {
            $section = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_price',
                $section . '_add_to_cart'
            ) );

            return 1;
        }

        public function sanitize_sort() {
            $section = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_sort_block',
                $section . '_popularity',
                $section . '_average_rating',
                $section . '_date',
                $section . '_price_asc',
                $section . '_price_desc',
            ) );

            return 1;
        }

        public function sanitize_original_btn_block() {
            $section = $_POST[ 'section' ];
            $this->update_fieldset( array(
                $section . '_original_btn_text',
            ) );

            $block_name = $this->options->get( $section . '_original_btn_block', 'name' );

            return isset( $_POST[ $block_name ] ) ? sanitize_text_field( $_POST[ $block_name ] ) : '';
        }

        public function get_section_fields( $id ) {
            $fields_order = get_option( self::ORDER_OPT );
            $fields_order = maybe_unserialize( $fields_order );
            $fields_order = isset( $fields_order[ $id ] ) ? maybe_unserialize( $fields_order[ $id ] ) : array();
            if ( ! count( $fields_order ) ) {
                return parent::get_section_fields( $id );
            }
            $fields = array();
            foreach ( $fields_order as $field_name ) {
                $fields[] = $this->search_field_id( $field_name );
            }

            $fields = array_merge( $fields, parent::get_section_fields( $id ) );

            // Move view option to top of list
            foreach ( array_reverse( $fields ) as $inx => $field ) {
                if ( isset( $field[ 'display_callback_args' ][ 'class' ] ) && $field[ 'display_callback_args' ][ 'class' ] == 'unsortable' ) {
                    array_unshift( $fields, $field );
                }
            }

            return $fields;
        }

        public function get_section_callback( $id ) {
            switch ( $id ) {
                case 'product':
                case 'shop':
                case 'wc_archives':
                    return array( $this, 'product_section_callback' );
                default:
                    return parent::get_section_callback( $id );
            }
        }

        public function product_section_callback( $page, $section ) {
            global $wp_settings_fields;

            echo '<table class="form-table">';
            $row_id = 0;
            foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
                $class = '';

                if ( empty( $field[ 'callback' ] ) || ! method_exists( $field[ 'callback' ][ 0 ], $field[ 'callback' ][ 1 ] ) ) {
                    continue;
                }

                if ( ! empty( $field[ 'args' ][ 'class' ] ) ) {
                    $class = ' class="' . esc_attr( $field[ 'args' ][ 'class' ] ) . '"';
                }
                echo "<tr data-name='{$field[ 'id' ]}' id='pos_{$row_id}' {$class}>";
                echo '<th class="drag"></th>';
                if ( ! empty( $field[ 'args' ][ 'label_for' ] ) ) {
                    echo '<th scope="row"><label for="' . esc_attr( $field[ 'args' ][ 'label_for' ] ) . '">' . $field[ 'title' ] . '</label></th>';
                } else {
                    echo '<th scope="row">' . $field[ 'title' ] . '</th>';
                }
                echo '<td>';
                call_user_func( $field[ 'callback' ], $field[ 'args' ] );
                echo '</td>';
                echo '</tr>';
                $row_id ++;
            }

            echo '</table>';
        }

    }

}