<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    load_textdomain('devvn-pricelistfilter', dirname(__FILE__) . '/languages/devvn-pricelistfilter-' . get_locale() . '.mo');
    class DevVN_Widget_Price_List_Filter extends WP_Widget {
        public function __construct() {
            $widget_ops = array(
                'classname' => 'devvn_woocommerce_price_list_filter woocommerce widget_layered_nav',
                'description' => __('Price List Filter for woocommerce', 'devvn-pricelistfilter'),
            );
            $control_ops = array(
                'width' => 500,
                'height' => 350,
            );
            parent::__construct( 'devvn_woocommerce_price_list_filter', __('Woocommerce Price List Filter','devvn-pricelistfilter'), $widget_ops, $control_ops );

        }
        public function widget( $args, $instance ) {
            global $wp, $wp_the_query;

            if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
                return;
            }

            $min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
            $max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

            // Find min and max price in current result set
            $prices = $this->get_filtered_price();
            $min    = floor( $prices->min_price );
            $max    = ceil( $prices->max_price );

            if ( $min === $max ) {
                return;
            }

            echo $args['before_widget'];

            if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            if ( '' === get_option( 'permalink_structure' ) ) {
                $form_action = remove_query_arg( array( 'page', 'paged' ), $this->get_page_base_url() );
            } else {
                $form_action = preg_replace( '%\/page/[0-9]+%', '', $this->get_page_base_url() );
            }

            /**
             * Adjust max if the store taxes are not displayed how they are stored.
             * Min is left alone because the product may not be taxable.
             * Kicks in when prices excluding tax are displayed including tax.
             */
            if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
                $tax_classes = array_merge( array( '' ), WC_Tax::get_tax_classes() );
                $class_max   = $max;

                foreach ( $tax_classes as $tax_class ) {
                    if ( $tax_rates = WC_Tax::get_rates( $tax_class ) ) {
                        $class_max = $max + WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max, $tax_rates ) );
                    }
                }

                $max = $class_max;
            }
            $min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
            $max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );

            $price_list = !empty( $instance['price_list'] ) ? $instance['price_list'] : array();
            $view_count = !empty( $instance['view_count'] ) ? intval($instance['view_count']) : 0;

            if($price_list && is_array($price_list)):
            ?>
            <ul class="woocommerce-widget-layered-nav-list">
                <?php foreach ($price_list as $range):
                    $active = '';
                    $min = isset($range['min']) ? $range['min'] : 0;
                    $max = isset($range['max']) ? $range['max'] : 0;
                    $label = isset($range['label']) ? esc_attr($range['label']) : '';
                    $arg_url_query = array();
                    if($min) $arg_url_query['min_price'] = $min;
                    if($max) $arg_url_query['max_price'] = $max;
                    if(!$max && $min){
                        $form_action = remove_query_arg( array( 'max_price' ), $this->get_page_base_url() );
                    }
                    if($max && !$min){
                        $form_action = remove_query_arg( array( 'min_price' ), $this->get_page_base_url() );
                    }
                    $form_action = add_query_arg(
                        $arg_url_query,
                        $form_action
                    );
                    if($view_count) {
                        $count_post = $this->get_count_post($min, $max);
                    }
                    if(
                        (isset($_GET['max_price']) && isset( $_GET['min_price'] ) && $max == $max_price && $min_price == $min)
                        ||
                        (isset($_GET['max_price']) && !isset( $_GET['min_price'] ) && $max == $max_price)
                        ||
                        (!isset($_GET['max_price']) && isset( $_GET['min_price'] ) && $min_price == $min)
                    ){
                        $active = 'active woocommerce-widget-layered-nav-list__item--chosen chosen';
                        $form_action = remove_query_arg( array( 'max_price', 'min_price' ), $this->get_page_base_url()  );
                    }
                    ?>
                    <li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term <?php echo $active;?>">
                        <a href="<?php echo esc_url($form_action);?>"><?php echo $label;?></a><?php if($view_count):?> <span class="count">(<?php echo $count_post;?>)</span><?php endif;?>
                    </li>
                <?php endforeach;?>
            </ul>
            <?php
            endif;
            echo $args['after_widget'];
        }
        public function form( $instance ) {
            $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
            $view_count = ! empty( $instance['view_count'] ) ? intval($instance['view_count']) : 0;
            $price_list = ! empty( $instance['price_list'] ) ? $instance['price_list'] : array();
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <div class="devvn_woo_price_filter">
                <table>
                    <thead>
                        <tr>
                            <th><?php _e('Min Price','devvn-pricelistfilter');?></th>
                            <th><?php _e('Max Price','devvn-pricelistfilter');?></th>
                            <th><?php _e('Label','devvn-pricelistfilter');?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4"><a href="javascript:void(0);" data-number="<?php echo $this->number;?>" class="button button-primary add_price_list"><?php _e('Add price range','devvn-pricelistfilter');?></a></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($price_list as $k=>$range):
                            $min = isset($range['min']) ? $range['min'] : 0;
                            $max = isset($range['max']) ? $range['max'] : 0;
                            $label = isset($range['label']) ? esc_attr($range['label']) : '';
                            ?>
                            <tr>
                                <td><input class="widefat" type="number" min="0" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[<?php echo $k;?>][min]" value="<?php echo $min;?>"></td>
                                <td><input class="widefat" type="number" min="0" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[<?php echo $k;?>][max]" value="<?php echo $max;?>"></td>
                                <td><input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[<?php echo $k;?>][label]" value="<?php echo $label;?>"></td>
                                <td class="devvn_td_delete"><a href="#" class="devvn_delete_price_list" title="<?php _e('Delete','devvn-pricelistfilter');?>">x</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <script type="text/html" id="tmpl-devvn-price-range-<?php echo $this->number;?>">
                <tr>
                    <td><input class="widefat" type="number" min="0" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[dk_{{data.index}}][min]"></td>
                    <td><input class="widefat" type="number" min="0" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[dk_{{data.index}}][max]"></td>
                    <td><input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( 'price_list' ) ); ?>[dk_{{data.index}}][label]"></td>
                    <td class="devvn_td_delete"><a href="#" class="devvn_delete_price_list" title="<?php _e('Delete','devvn-pricelistfilter');?>">x</a></td>
                </tr>
                </script>
            </div>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>">
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_count' ) ); ?>" type="checkbox" value="1" <?php checked(1,$view_count);?>> <?php _e( esc_attr( 'View count product','devvn-pricelistfilter' ) ); ?>
                </label>
            </p>
            <?php
        }
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['view_count'] = ! empty( $new_instance['view_count'] ) ? intval($new_instance['view_count']) : 0;
            $instance['price_list'] = ( ! empty( $new_instance['price_list'] ) ) ? $new_instance['price_list'] : array();
            return $instance;
        }
        protected function get_filtered_price() {
            global $wpdb, $wp_the_query;

            $args       = $wp_the_query->query_vars;
            $tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
            $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

            if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
                $tax_query[] = array(
                    'taxonomy' => $args['taxonomy'],
                    'terms'    => array( $args['term'] ),
                    'field'    => 'slug',
                );
            }

            foreach ( $meta_query + $tax_query as $key => $query ) {
                if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
                    unset( $meta_query[ $key ] );
                }
            }

            $meta_query = new WP_Meta_Query( $meta_query );
            $tax_query  = new WP_Tax_Query( $tax_query );

            $meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
            $tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

            $sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
            $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
            $sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
            $sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

            if ( $search = WC_Query::get_main_search_query_sql() ) {
                $sql .= ' AND ' . $search;
            }

            return $wpdb->get_row( $sql );
        }
        protected function get_page_base_url() {
            if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
                $link = home_url();
            } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
                $link = get_post_type_archive_link( 'product' );
            } elseif ( is_product_category() ) {
                $link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
            } elseif ( is_product_tag() ) {
                $link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
            } else {
                $queried_object = get_queried_object();
                $link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
            }

            // Min/Max
            if ( isset( $_GET['min_price'] ) ) {
                $link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
            }

            if ( isset( $_GET['max_price'] ) ) {
                $link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
            }

            // Order by
            if ( isset( $_GET['orderby'] ) ) {
                $link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
            }

            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if ( get_search_query() ) {
                $link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
            }

            // Post Type Arg
            if ( isset( $_GET['post_type'] ) ) {
                $link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
            }

            // Min Rating Arg
            if ( isset( $_GET['rating_filter'] ) ) {
                $link = add_query_arg( 'rating_filter', wc_clean( $_GET['rating_filter'] ), $link );
            }

            // All current filters
            if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
                foreach ( $_chosen_attributes as $name => $data ) {
                    $filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
                    if ( ! empty( $data['terms'] ) ) {
                        $link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
                    }
                    if ( 'or' == $data['query_type'] ) {
                        $link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
                    }
                }
            }

            return $link;
        }

        function get_count_post($min_price = '', $max_price = ''){
            if(!$min_price && !$max_price) return;
            global $wp_the_query;
            $old_query       = $wp_the_query->query_vars;
            if(!$min_price && $max_price){
                $meta_price = array(
                    array(
                        'key' => '_price',
                        'value' => $max_price,
                        'compare' => '<=',
                        'type' => 'NUMERIC'
                    )
                );
            }
            if(!$max_price && $min_price){
                $meta_price = array(
                    array(
                        'key' => '_price',
                        'value' => $min_price,
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    )
                );
            }
            if($min_price && $max_price){
                $meta_price = array(
                    array(
                        'key' => '_price',
                        'value' => array($min_price, $max_price),
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    )
                );
            }
            $args = array(
                'post_type' => array('product'),
                'post_status'   =>  'publish',
                'posts_per_page'    =>  -1,
                'meta_query' => $meta_price
            );

            $tax_query  = isset( $old_query['tax_query'] ) ? $old_query['tax_query'] : array();
            if ( version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'exclude-from-catalog',
                    'operator' => 'NOT IN',
                );
            } else {
                $args['meta_query'][] = array(
                    'key' => '_visibility',
                    'value' => array( 'catalog', 'visible' ),
                    'compare' => 'IN'
                );
            }
            if(is_tax()){
                if ( ! empty( $old_query['taxonomy'] ) && ! empty( $old_query['term'] ) ) {
                    $tax_query[] = array(
                        'taxonomy' => $old_query['taxonomy'],
                        'terms'    => array( $old_query['term'] ),
                        'field'    => 'slug',
                    );
                }
            }
            $args['tax_query']  = $tax_query;
            $myposts = get_posts($args);
            return count($myposts);
        }
    }
    function register_devvn_woo_price_widget() {
        register_widget( 'DevVN_Widget_Price_List_Filter' );
    }
    add_action( 'widgets_init', 'register_devvn_woo_price_widget' );


    function devvn_pricelist_register_scripts() {

        $current_screen = get_current_screen();
        if(isset($current_screen->base) && $current_screen->base == 'widgets') {
            wp_enqueue_script( 'wp_enqueue_script', get_stylesheet_directory_uri().'/assets/price-filter/price-list-filter.js' );
            wp_enqueue_style( 'wp_enqueue_style', get_stylesheet_directory_uri().'/assets/price-filter/price-list-filter.css' );
        }
    }
    add_action('admin_enqueue_scripts', 'devvn_pricelist_register_scripts');
    }