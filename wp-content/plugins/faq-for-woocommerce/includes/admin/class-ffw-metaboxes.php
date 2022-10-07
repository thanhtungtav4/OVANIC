<?php
/**
 * Add Metaboxes
 *
 * @package FAQ_Woocommerce\Admin
 * @version 1.4.0
 */
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('FFW_Metaboxes', false)) :

    /**
     * FFW_Metaboxes Class.
     */
    class FFW_Metaboxes
    {

        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save' ) );
        }

        /**
         * Get product support, Specific/Global product support.
         *
         */
        public function get_product_support() {
            return apply_filters('ffw_is_global_product_support_enable', false);
        }

        /**
         * Add Metaboxes.
         *
         * @param mixed $post_type post type
         */
        public function add_meta_boxes($post_type) {
            // metabox for `ffw` post type.
            $post_types = array( 'ffw' );

            if ( in_array( $post_type, $post_types ) ) {
                add_meta_box(
                    'ffw_faq_meta_settings',
                    __( 'FAQs Meta Settings', 'faq-for-woocommerce' ),
                    array( $this, 'meta_box_content' ),
                    $post_type,
                    'normal',
                    'high'
                );
            }
        }

        /**
         * Meta Box content.
         *
         * @param WP_Post $post The post object.
         */
        public function meta_box_content( $post ) {

            //faq post ID
            $faq_id = $post->ID;

            // add nonce field
            wp_nonce_field( 'ffw_faq_product_settings', 'ffw_faq_product_settings_nonce' );

            $is_global_product_support_enable = $this->get_product_support();

            if( ! $is_global_product_support_enable ) {
                // get product ids with faqs
                $args = array(
                    'post_type'  => array('product'),
                    'meta_query' => array(
                        array(
                            'key'     => 'ffw_product_faq_post_ids',
                            'compare' => 'EXISTS'
                        ),
                    ),
                    'fields' => 'ids',
                    'posts_per_page' => -1,
                );
                $product_ids = get_posts( $args );
                ?>
                <div class="ffw-metabox-wrapper woocommerce">
                    <table class="form-table ffw-admin-form-table">
                        <tr class="ffw-product-search-row">
                            <th scope="row" class="titledesc">
                                <label for="ffw_faq_products">
                                    <?php _e( 'Products', 'faq-for-woocommerce' ); ?>
                                </label>
                            </th>
                            <td class="forminp forminp-multi-select-search">
                                <select
                                        name="ffw_faq_products[]"
                                        class="wc-product-search"
                                        multiple="multiple"
                                        id="ffw_faq_products"
                                        data-allow_clear="true"
                                        data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'faq-for-woocommerce' ); ?>"
                                        data-exclude_type="variation"
                                        data-action="woocommerce_json_search_products_and_variations"
                                >
                                    <?php
                                    if( isset($product_ids) && ! empty($product_ids) ) {
                                        foreach ( $product_ids as $product_id ) {
                                            $product = wc_get_product( $product_id );
                                            $faq_ids = get_post_meta($product_id, 'ffw_product_faq_post_ids', true);

                                            if ( $product ) {
                                                if( isset($faq_ids) && ! empty($faq_ids) && is_array($faq_ids) && in_array($faq_id, $faq_ids) ) {
                                                    echo '<option value="' . esc_attr( $product_id ) . '" selected="selected">' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <p class="description"><?php _e('Search and Select products for the FAQ.', 'faq-for-woocommerce'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php
            }


        }

        /**
         * Save the meta when the post is saved.
         *
         * @param int $post_id The ID of the post being saved.
         */
        public function save( $post_id ) {

            // when nonce is not set, do nothing
            if ( ! isset( $_POST['ffw_faq_product_settings_nonce'] ) ) {
                return $post_id;
            }

            $nonce = wp_unslash($_POST['ffw_faq_product_settings_nonce']);

            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $nonce, 'ffw_faq_product_settings' ) ) {
                return $post_id;
            }

            /*
             * If this is an autosave, our form has not been submitted,
             * so we don't want to do anything.
             */
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }

            // Check the user's permissions.
            if ( 'ffw' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                }
            }

            $is_global_product_support_enable = $this->get_product_support();

            if( ! $is_global_product_support_enable ) {
                // Sanitize the faqs products field value.
                $product_ids = $_POST['ffw_faq_products'];

                // Manipulate FAQ data for the product
                if( isset($product_ids) && is_array($product_ids) && !empty($product_ids) ) {
                    foreach($product_ids as $product_id) {

                        // get product faqs
                        $faq_ids = get_post_meta($product_id, 'ffw_product_faq_post_ids', true);

                        // when no faqs is set, put empty array
                        if( empty($faq_ids) ) {
                            $faq_ids = [];
                        }

                        //push the faq id
                        array_push($faq_ids, $post_id);

                        //remove duplicate faq id
                        $faq_ids = array_unique($faq_ids);

                        // Update the meta field.
                        update_post_meta( $product_id, 'ffw_product_faq_post_ids', $faq_ids );
                    }
                }
            }

        }

    }

endif;

return new FFW_Metaboxes();