<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die();
}
if ( ! class_exists( 'AMPHTML_Options' ) ) {

    class AMPHTML_Options {

        const OPTIONS_PAGE           = 'amphtml-options';
        const NAV_MENU               = 'amphtml-menu';
        const NAV_MENU_FOOTER        = 'amphtml-menu-footer';
        const TINY_MCE_INIT_CALLBACK = 'amphtml.postSettings.init';

        static $options = array();
        static $fields  = array();
        protected $tab_name;

        /**
         * @var AMPHTML_Tab
         */
        protected $tabs;

        public function __construct() {
            if ( is_admin() ) {
                add_action( 'admin_menu', array( $this, 'admin_menu' ) );
                $this->add_amphtml_menu_location();
                add_action( 'wp_before_admin_bar_render', array( $this, 'custom_link' ) );
                add_action( 'admin_bar_menu', array( $this, 'admin_bar_menus' ), 31 );
                add_action( 'add_meta_boxes', array( $this, 'add_exclude_from_amphtml_metabox' ) );
                add_action( 'save_post', array( $this, 'save_amphtml_meta_box' ), 10, 3 );
                add_action( 'load-options-permalink.php', array( $this, 'add_endpoint_settings' ) );
                add_filter( 'tiny_mce_before_init', array( $this, 'add_amphtml_init' ) );

                add_action( 'category_edit_form', array( $this, 'display_amp_taxonomy_exclude' ), 9, 2 );
                add_action( 'post_tag_edit_form', array( $this, 'display_amp_taxonomy_exclude' ), 9, 2 );
                add_action( 'product_cat_edit_form', array( $this, 'display_amp_taxonomy_exclude' ), 9, 2 );
                add_action( 'product_tag_edit_form', array( $this, 'display_amp_taxonomy_exclude' ), 9, 2 );

                add_action( 'edited_term', array( $this, 'save_amp_taxonomy_meta_data' ), 20, 3 );
            }

            if ( is_wp_amp() || is_admin() ) {
                $this->init_tabs();
            }

            $this->init_options();
        }

        public function display_amp_taxonomy_exclude( $tag, $taxonomy ) {
            $checked_exclude_posts = apply_filters( 'amphtml_exclude_meta', get_term_meta( $tag->term_id, "amphtml-exclude-posts", true ) );
            $checked_exclude_term = apply_filters( 'amphtml_exclude_meta', get_term_meta( $tag->term_id, "amphtml-exclude-term", true ) );
            $post_types_amp = $this->set_selected_post_type();
            $post_type = $taxonomy == 'category' || $taxonomy == 'post_tag' ? 'post' : 'product';
            $exclude_posts_label = $taxonomy == 'category' || $taxonomy == 'product_cat' ? 'Disable AMP version for all posts within this category' : 'Disable AMP version for all posts with this tag';
            $posts_amp_visible = in_array($post_type, $post_types_amp);
            $archives_allowed_pages = $this->get( 'archives' );
            $taxonomy_code = $taxonomy == 'post_tag' ? 'tag' : $taxonomy;
            $category_amp_visible = in_array($taxonomy_code, $archives_allowed_pages);
            if( $posts_amp_visible && $category_amp_visible ) :
        ?>

                <h2><?php _e( 'WP AMP visibility', 'amphtml' ); ?></h2>
                <table class="form-table">
                    <tbody>
                        <?php if( $category_amp_visible ) : ?>
                            <tr class="form-field">
                                <th scope="row"><label for="amphtml-exclude-term"><?php _e( 'Disable AMP version of this page', 'amphtml' ); ?></label></th>
                                <td>
                                    <input name="amphtml-exclude-term" id="amphtml-exclude-term" type="checkbox" value="1"
                                        <?php
                                            if ( $checked_exclude_term == '1' ):
                                                echo 'checked';
                                            endif; ?> />
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if( $posts_amp_visible ) : ?>
                            <tr class="form-field">
                                <th scope="row"><label for="amphtml-exclude-posts"><?php _e( $exclude_posts_label, 'amphtml' ); ?></label></th>
                                <td>
                                    <input name="amphtml-exclude-posts" id="amphtml-exclude-posts" type="checkbox"  value="1"
                                        <?php
                                            if ( $checked_exclude_posts == '1' ):
                                                echo 'checked';
                                            endif; ?> />
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
        <?php
            endif;
        }

        public function save_amp_taxonomy_meta_data( $term_id, $tt_id, $taxonomy ) {
            if( isset( $_POST['amphtml-exclude-term'] ) && ! empty( $_POST['amphtml-exclude-term'] ) ) {
                update_term_meta( $term_id, 'amphtml-exclude-term', '1' );
            } else {
                delete_term_meta( $term_id, 'amphtml-exclude-term' );
            }
            if( isset( $_POST['amphtml-exclude-posts'] ) && ! empty( $_POST['amphtml-exclude-posts'] ) ) {
                update_term_meta( $term_id, 'amphtml-exclude-posts', true );
            } else {
                delete_term_meta( $term_id, 'amphtml-exclude-posts' );
            }
        }

        public function add_endpoint_settings() {
            if ( isset( $_POST[ $this->get( 'endpoint', 'name' ) ] ) ) {
                update_option( $this->get( 'endpoint', 'name' ), $this->sanitize_endpoint( $_POST[ $this->get( 'endpoint', 'name' ) ] ) );
            }

            // Add a settings field to the permalink page
            add_settings_field( $this->get( 'endpoint', 'name' ), __( 'WP AMP Endpoint', 'amphtml' ), array(
                $this,
                'endpoint_field_callback'
            ), 'permalink', 'optional' );
        }

        public function endpoint_field_callback() {
            printf( "<input type='text' value='%s' name='%s' id='%s' class='regular-text'>", esc_attr( AMPHTML()->get_endpoint() ), $this->get( 'endpoint', 'name' ), $this->get( 'endpoint', 'name' ) );
            echo '<span class="description"> ' . $this->get( 'endpoint', 'description' ) . '</span>';
        }

        public function sanitize_endpoint( $endpoint ) {
            $endpoint = sanitize_title( $endpoint );
            if ( ! $endpoint ) {
                add_settings_error( $this->get( 'endpoint', 'name' ), 'endpoint_error', __( 'Insert a valid endpoint', 'amphtml' ), 'error' );
                $valid_field = $this->get( 'endpoint' );
            } else {
                $valid_field = $endpoint;
            }

            return $valid_field;
        }

        public function init_tabs() {
            $this->tabs = new AMPHTML_Tab( $this );
            $this->tabs->create();
        }

        public function get_tabs() {
            return $this->tabs;
        }

        public function custom_link() {
            global $wp_admin_bar;
            $id = $this->get_request_var( 'post' );
            if ( ! is_admin() || ! is_user_logged_in() || AMPHTML()->is_excluded( $id ) ) {
                return;
            }

            $preview_link = get_permalink( $this->get_request_var( 'post' ) );
            if ( $this->get_request_var( 'post' ) && 'edit' == $this->get_request_var( 'action' ) ) {
                $wp_admin_bar->add_menu( array(
                    'parent' => false,
                    'id'     => 'view-amphtml',
                    'title'  => __( 'View AMP Version', 'amphtml' ),
                    'href'   => $this->get_amphtml_link( $preview_link ),
                    'meta'   => false
                ) );
            }
        }

        public function admin_bar_menus( $wp_admin_bar ) {
            if ( ! is_admin() || ! is_user_logged_in() ) {
                return;
            }
            if ( ! AMPHTML()->is_excluded_posts_page() ) {
                $wp_admin_bar->add_node( array(
                    'parent' => 'site-name',
                    'id'     => 'visit-amphtml',
                    'title'  => __( 'Visit AMP Site', 'amphtml' ),
                    'href'   => $this->get_amphtml_link( home_url() . '/' ),
                ) );
            }
        }

        public static function get_amphtml_link( $link, $id = '' ) {
            $id = $id ? $id : url_to_postid( $link );
            if ( AMPHTML()->is_excluded( $id ) ) {
                return $link;
            }
            if ( '' != get_option( 'permalink_structure' ) ) {
                $link = trailingslashit( $link );

                return user_trailingslashit( $link . AMPHTML()->get_endpoint() );
            }

            return add_query_arg( AMPHTML()->get_endpoint(), '1', $link );
        }

        public function init_options() {
            $fields  = unserialize( get_transient( 'amphtml_fields' ) );
            $options = get_transient( 'amphtml_options' );
            if ( is_admin() || ( empty( $fields ) || empty( $options ) ) ) {
                foreach ( self::get_fields() as $key => $field ) {
                    $option_name                     = self::get_field_name( $field[ 'id' ] );
                    $default                         = ( isset( $field[ 'default' ] ) ) ? $field[ 'default' ] : false;
                    self::$options[ $field[ 'id' ] ] = get_option( $option_name, $default );
                    self::$fields[ $key ][ 'value' ] = get_option( $option_name, $default );
                    self::$fields[ $key ][ 'name' ]  = $option_name;
                }

                self::$fields[ 'amphtml_menu' ]        = array(
                    'id'    => 'amphtml_menu',
                    'value' => self::NAV_MENU
                );
                self::$fields[ 'amphtml_menu_footer' ] = array(
                    'id'    => 'amphtml_menu_footer',
                    'value' => self::NAV_MENU_FOOTER
                );
                set_transient( 'amphtml_fields', serialize( self::$fields ) );
                set_transient( 'amphtml_options', self::$options );
                delete_transient( 'amphtml_template_blocks_order' );
            } else {
                self::$fields  = $fields;
                self::$options = $options;
            }
        }

        protected static function get_fields() {
            return self::$fields;
        }

        static function get_field_name( $id ) {
            return 'amphtml_' . $id;
        }

        public static function add_fields( $fields ) {
            foreach ( $fields as $field ) {
                self::$fields[ $field[ 'id' ] ] = $field;
            }
        }

        public function admin_menu() {
            add_options_page( 'WP AMP Settings', 'WP AMP', 'manage_options', self::OPTIONS_PAGE, array(
                $this,
                'settings_page'
            ) );
        }

        public function add_amphtml_menu_location() {
            register_nav_menu( self::NAV_MENU, __( 'AMP Menu', 'amphtml' ) );
            register_nav_menu( self::NAV_MENU_FOOTER, __( 'AMP Menu Footer', 'amphtml' ) );
        }

        public function get( $id, $attr = '' ) {

            if ( ! isset( self::$fields[ $id ] ) ) {
                return '';
            }
            if ( $attr ) {
                return isset( self::$fields[ $id ][ $attr ] ) ? self::$fields[ $id ][ $attr ] : '';
            }

            if( ! empty( self::$fields[ $id ]['display_callback'] ) && is_array( self::$fields[ $id ]['display_callback'] ) && self::$fields[ $id ]['display_callback'][1] == 'display_multiple_select' ) {
                if( empty( self::$fields[ $id ][ 'value' ] ) ) {
                    self::$fields[ $id ][ 'value' ] = [];
                }
            }

            return self::$fields[ $id ][ 'value' ];
        }

        public function get_options() {
            return self::$options;
        }

        /**
         * Function that will check if value is a valid HEX color.
         */
        public function check_header_color( $value ) {

            if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #
                return true;
            }

            return false;
        }

        public function is_success( $value ) {
            return $value;
        }

        public function settings_page() {
            ?>
            <div class="wrap">
                <h1><?php _e( 'WP AMP Settings', 'amphtml' ) ?></h1>
                <form id="amp-settings" method="POST" action="options.php">
                    <h2 class="nav-tab-wrapper">
            <?php foreach ( $this->tabs->get_list() as $name => $label ): ?>
                            <a href="<?php echo $this->get_tab_url( $name ) ?>"
                               class="nav-tab <?php echo( $this->tabs->get_current() == $name ? 'nav-tab-active' : '' ) ?>"><?php echo $label ?></a>
            <?php endforeach; ?>
                    </h2>
                    <input type="hidden" name="tab" value="<?php echo esc_attr( $this->tabs->get_current() ) ?>"/>
                    <input type="hidden" name="section"
                           value="<?php echo esc_attr( $this->tabs->get_current_section() ) ?>"/>
                           <?php
                           do_action( 'amphtml_proceed_settings_form', $this );
                           settings_fields( self::OPTIONS_PAGE );
                           $this->output_sections_nav( $this->tabs->get_current(), $this->tabs->get_current_section() );
                           if ( $this->get_request_var( 'reset' ) ) { //todo move to properly tab class
                               $this->reset_options();
                           }
                           $this->do_settings_sections( self::OPTIONS_PAGE, $this->tabs->get_current_section() );
                           $this->tabs->get( $this->tabs->get_current() )->get_submit();
                           ?>
                </form>
            <?php do_action( 'amphtml_after_settings_form' ) ?>
            </div>
            <?php
        }

        public function get_tab_url( $tab, $section = '' ) {
            $args = array(
                'page' => self::OPTIONS_PAGE,
                'tab'  => $tab
            );
            if ( $section ) {
                $args[ 'section' ] = $section;
            }

            return add_query_arg( $args, admin_url( 'options-general.php' ) );
        }

        public function get_request_var( $var, $default = "" ) {
            return isset( $_REQUEST[ $var ] ) ? $_REQUEST[ $var ] : $default;
        }

        public function reset_options() {
            $current_tab     = $this->tabs->get_current();
            $default_options = $this->get_default_fileds( $current_tab );
            foreach ( $default_options as $option => $value ) {
                $name = self::get_field_name( $option );
                add_filter( 'sanitize_option_' . self::get_field_name( $option ), array( $this, 'is_success' ) );
                update_option( self::get_field_name( $option ), $value );
            }
            $this->init_options();
        }

        public function get_default_fileds( $tab_name ) {
            $current_tab = $this->tabs->get( $tab_name );
            $fields      = $current_tab->get_fields();

            $default_fields = array();
            foreach ( $fields as $field ) {
                if ( isset( $field[ 'default' ] ) ) {
                    $default_fields[ $field[ 'id' ] ] = $field[ 'default' ];
                }
            }

            return $default_fields;
        }

        /**
         * Output sections navigation.
         */
        public function output_sections_nav( $current_tab, $current_section ) {

            $sections = $this->tabs->get( $current_tab )->get_sections();
            if ( empty( $sections ) || 1 === sizeof( $sections ) ) {
                return;
            }

            echo '<ul class="subsubsub">';
            $array_keys = array_keys( $sections );

            foreach ( $sections as $id => $label ) {
                echo '<li><a href="' . $this->get_tab_url( $current_tab, $id ) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end( $array_keys ) == $id ? '' : '|' ) . ' </li>';
            }

            echo '</ul><br class="clear" />';
        }

        public function do_settings_sections( $page, $current_section ) {
            global $wp_settings_sections, $wp_settings_fields;

            if ( ! isset( $wp_settings_sections[ $page ] ) ) {
                return;
            }

            $section = (array) $wp_settings_sections[ $page ][ $current_section ];
            $check   = amp_check_license();
            if ( empty( $check[ 'status' ] ) || ( empty( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] != 'license' ) ) {
                if ( $section[ 'callback' ] ) {
                    call_user_func( $section[ 'callback' ], $page, $section[ 'id' ] );
                } else {
                    $this->do_settings_fields( $page, $section[ 'id' ] );
                }
            } else {
                echo '<div class="license-activated-notice"><p>' . __( $check[ 'message' ], 'phone-share' ) . '</p></div>';
            }
        }

        public function do_settings_fields( $page, $section ) {
            global $wp_settings_fields;

            if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
                return;
            }
            $row_id = 0;
            echo '<table class="form-table">';
            foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
                $class = '';

                if ( ! method_exists( $field[ 'callback' ][ 0 ], $field[ 'callback' ][ 1 ] ) ) {
                    continue;
                }

                if ( ! empty( $field[ 'args' ][ 'class' ] ) ) {
                    $class = ' class="' . esc_attr( $field[ 'args' ][ 'class' ] ) . '"';
                }

                echo "<tr data-name='{$field[ 'id' ]}' id='pos_{$row_id}' {$class}>";

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

        public function set_selected_post_type() {
            $fields = $this->get_fields();
            $check  = $fields[ 'post_types' ][ 'value' ];

            return $check;
        }

        public function add_exclude_from_amphtml_metabox() {
            $cpt_selected = $this->set_selected_post_type();

            if ( ! empty( $cpt_selected ) ) {

                add_meta_box( 'amphtml-metabox-exclude', 'WP AMP Page Visibility', array(
                    $this,
                    'display_amp_exclude'
                ), $this->set_selected_post_type() );
                add_meta_box( 'amphtml-metabox-settings', 'WP AMP Settings', array(
                    $this,
                    'display_amp_options'
                ), $this->set_selected_post_type() );
                add_meta_box( 'amphtml-featured-image', __( 'WP AMP featured Image', 'amphtml' ), array(
                    $this,
                    'custom_featured_image'
                ), $this->set_selected_post_type(), 'side', 'low' );
                if( in_array( 'product', $this->set_selected_post_type() ) ) {
                    add_meta_box( 'amphtml-archive-image', __( 'WP AMP archive Image', 'amphtml' ), array(
                        $this,
                        'custom_archive_image'
                    ), [ 'product' ], 'side', 'low' );
                }
            }
        }

        public function display_amp_exclude( $object ) {
            echo '<div>';
            $this->display_exclude_options( $object );
            echo '</div>';
        }

        public function display_amp_options( $object ) {
            echo '<div>';
            $this->custom_title( $object );
            $this->custom_content( $object );
            echo '</div>';
        }

        public function custom_featured_image( $post ) {
            global $content_width, $_wp_additional_image_sizes;
            $image_id          = get_post_meta( $post->ID, 'amphtml_featured_image_id', true );
            $old_content_width = $content_width;
            $content_width     = 254;
            $content           = '';
            if ( $image_id && get_post( $image_id ) ) {
                if ( ! isset( $_wp_additional_image_sizes[ 'post-thumbnail' ] ) ) {
                    $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
                } else {
                    $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
                }
                if ( ! empty( $thumbnail_html ) ) {
                    $content = $thumbnail_html;
                    $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_listing_image_button" >' . esc_html__( 'Remove featured image', 'amphtml' ) . '</a></p>';
                    $content .= '<input type="hidden" id="upload_listing_image" name="_amphtml_featured_image" value="' . esc_attr( $image_id ) . '" />';
                }
                $content_width = $old_content_width;
            } else {
                $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
                $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set featured Image', 'amphtml' ) . '" href="javascript:;" id="upload_listing_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'amphtml' ) . '" data-uploader_button_text="' . esc_attr__( 'Set featured Image', 'amphtml' ) . '">' . esc_html__( 'Set featured Image', 'amphtml' ) . '</a></p>';
                $content .= '<input type="hidden" id="upload_listing_image" name="_amphtml_featured_image" value="" />';
            }
            echo $content;
            ?>
            <script>
                jQuery(document).ready(function ($) {

            	// Uploading files
            	var file_frame;
            	var amphtml_metabox = $('#amphtml-featured-image');

            	$.fn.upload_listing_image = function (button) {
            	    var button_id = button.attr('id');
            	    var field_id = button_id.replace('_button', '');

            	    // If the media frame already exists, reopen it.
            	    if (file_frame) {
            		file_frame.open();
            		return;
            	    }

            	    // Create the media frame.
            	    file_frame = wp.media.frames.file_frame = wp.media({
            		title: $(this).data('uploader_title'),
            		button: {
            		    text: $(this).data('uploader_button_text'),
            		},
            		multiple: false
            	    });

            	    // When an image is selected, run a callback.
            	    file_frame.on('select', function () {
            		var attachment = file_frame.state().get('selection').first().toJSON();
            		$("#" + field_id).val(attachment.id);
            		amphtml_metabox.find('img').attr('src', attachment.url).show();
            		$('#' + button_id).attr('id', 'remove_listing_image_button');
            		$('#remove_listing_image_button').text('Remove featured image');
            	    });

            	    // Finally, open the modal
            	    file_frame.open();
            	};

            	amphtml_metabox.on('click', '#upload_listing_image_button', function (event) {
            	    event.preventDefault();
            	    $.fn.upload_listing_image($(this));
            	});

            	amphtml_metabox.on('click', '#remove_listing_image_button', function (event) {
            	    event.preventDefault();
            	    $('#upload_listing_image').val('');
            	    amphtml_metabox.find('img').attr('src', '').hide();
            	    $(this).attr('id', 'upload_listing_image_button');
            	    $('#upload_listing_image_button').text('Set featured Image');
            	});

                });
            </script>
            <?php
        }

        public function custom_archive_image( $post ) {
            global $content_width, $_wp_additional_image_sizes;
            $image_id          = get_post_meta( $post->ID, 'amphtml_archive_image_id', true );
            $old_content_width = $content_width;
            $content_width     = 254;
            $content           = '';
            if ( $image_id && get_post( $image_id ) ) {
                if ( ! isset( $_wp_additional_image_sizes[ 'post-thumbnail' ] ) ) {
                    $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
                } else {
                    $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
                }
                if ( ! empty( $thumbnail_html ) ) {
                    $content = $thumbnail_html;
                    $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_amp_archive_image_button" >' . esc_html__( 'Remove archive image', 'amphtml' ) . '</a></p>';
                    $content .= '<input type="hidden" id="upload_amp_archive_image" name="_amphtml_archive_image" value="' . esc_attr( $image_id ) . '" />';
                }
                $content_width = $old_content_width;
            } else {
                $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
                $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set archive Image', 'amphtml' ) . '" href="javascript:;" id="upload_amp_archive_image_button" id="set-listing-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'amphtml' ) . '" data-uploader_button_text="' . esc_attr__( 'Set archive Image', 'amphtml' ) . '">' . esc_html__( 'Set archive Image', 'amphtml' ) . '</a></p>';
                $content .= '<input type="hidden" id="upload_amp_archive_image" name="_amphtml_archive_image" value="" />';
            }
            echo $content;
            ?>
            <script>
                jQuery(document).ready(function ($) {

                // Uploading files
                var file_frame;
                var amphtml_metabox = $('#amphtml-archive-image');

                $.fn.upload_amp_archive_image = function (button) {
                    var button_id = button.attr('id');
                    var field_id = button_id.replace('_button', '');

                    // If the media frame already exists, reopen it.
                    if (file_frame) {
                        file_frame.open();
                        return;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: $(this).data('uploader_title'),
                        button: {
                            text: $(this).data('uploader_button_text'),
                        },
                        multiple: false
                    });

                    // When an image is selected, run a callback.
                    file_frame.on('select', function () {
                        var attachment = file_frame.state().get('selection').first().toJSON();
                        $("#" + field_id).val(attachment.id);
                        amphtml_metabox.find('img').attr('src', attachment.url).show();
                        $('#' + button_id).attr('id', 'remove_amp_archive_image_button');
                        $('#remove_amp_archive_image_button').text('Remove archive image');
                    });

                    // Finally, open the modal
                    file_frame.open();
                };

                amphtml_metabox.on('click', '#upload_amp_archive_image_button', function (event) {
                    event.preventDefault();
                    $.fn.upload_amp_archive_image($(this));
                });

                amphtml_metabox.on('click', '#remove_amp_archive_image_button', function (event) {
                    event.preventDefault();
                    $('#upload_amp_archive_image').val('');
                    amphtml_metabox.find('img').attr('src', '').hide();
                    $(this).attr('id', 'upload_amp_archive_image_button');
                    $('#upload_amp_archive_image_button').text('Set archive Image');
                });
            });
            </script>
            <?php
        }

        public function custom_content( $object ) {
            ?>
            <p>
            <?php $checked = get_post_meta( $object->ID, "amphtml-override-content", true ); ?>
                <input style="margin: 0 3px" name="amphtml-override-content" type="checkbox"
                       value="true" <?php
                       if ( $checked == 'true' ): echo 'checked';
                       endif;
                       ?>>
                <label for="amphtml-override-content"><?php _e( "Override AMP Content", 'amphtml' ) ?></label>
            </p>
            <?php
            wp_editor( get_post_meta( $object->ID, "amphtml-custom-content", true ), 'amphtml-custom-content' );
        }

        public function custom_title( $object ) {
            ?>
            <p>
                <label for="amphtml-custom-title"><?php _e( 'Title', 'amphtml' ) ?></label>
                <input type="text" name="amphtml-custom-title" size="30"
                       value="<?php echo get_post_meta( $object->ID, "amphtml-custom-title", true ); ?>"
                       spellcheck="true" autocomplete="off">
            <?php $checked = get_post_meta( $object->ID, "amphtml-override-title", true ); ?>
                <input style="margin: 0 3px" name="amphtml-override-title" type="checkbox"
                       value="true" <?php
                       if ( $checked == 'true' ): echo 'checked';
                       endif;
                       ?>>
                <label for="amphtml-override-title"><?php _e( "Override AMP Title", 'amphtml' ) ?></label>
            </p>
            <?php
        }

        public function display_exclude_options( $object ) {
            wp_nonce_field( basename( __FILE__ ), 'amphtml-metabox' );
            ?>
            <p>
                <label for="amphtml-metabox"><?php _e( "Disable AMP version of this page", 'amphtml' ) ?></label>
            <?php $checked = apply_filters( 'amphtml_exclude_meta', get_post_meta( $object->ID, "amphtml-exclude", true ) ); ?>
                <input style="margin: 0 3px" name="amphtml-exclude" type="checkbox"
                       value="true" <?php
                       if ( $checked == 'true' ): echo 'checked';
                       endif;
                       ?>>
            </p>
            <?php
        }

        public function save_amphtml_meta_box( $post_id, $post, $update ) {
            if ( ! isset( $_POST[ "amphtml-metabox" ] ) || ! wp_verify_nonce( $_POST[ "amphtml-metabox" ], basename( __FILE__ ) ) ) {
                return $post_id;
            }

            if ( ! current_user_can( "edit_post", $post_id ) ) {
                return $post_id;
            }

            if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
                return $post_id;
            }


            if ( isset( $_POST[ '_amphtml_featured_image' ] ) ) {
                $image_id = (int) $_POST[ '_amphtml_featured_image' ];
                update_post_meta( $post_id, 'amphtml_featured_image_id', $image_id );
            }

            if ( isset( $_POST[ '_amphtml_archive_image' ] ) ) {
                $image_id = (int) $_POST[ '_amphtml_archive_image' ];
                update_post_meta( $post_id, 'amphtml_archive_image_id', $image_id );
            }

            if ( isset( $_POST[ 'amphtml-exclude' ] ) ) {
                update_post_meta( $post_id, 'amphtml-exclude', $_POST[ 'amphtml-exclude' ] );
            } else {
                // 0 - is required for filters, don't use false here
                update_post_meta( $post_id, 'amphtml-exclude', 0 );
            }

            if ( ! isset( $_POST[ 'amphtml-exclude' ] ) ) {
                $override_options = array(
                    'amphtml-override-title'   => '',
                    'amphtml-override-content' => '',
                );

                $options = array_intersect_key( $_POST, $override_options );
                $options = wp_parse_args( $options, $override_options );

                foreach ( $options as $opt_id => $value ) {
                    update_post_meta( $post_id, $opt_id, $value );
                }

                if ( isset( $_POST[ 'amphtml-custom-title' ] ) && $options[ 'amphtml-override-title' ] ) {
                    update_post_meta( $post_id, 'amphtml-custom-title', $_POST[ 'amphtml-custom-title' ] );
                }

                if ( isset( $_POST[ 'amphtml-custom-content' ] ) && $options[ 'amphtml-override-content' ] ) {
                    update_post_meta( $post_id, 'amphtml-custom-content', $_POST[ 'amphtml-custom-content' ] );
                }
            }
        }

        public function get_section_fields( $section ) {
            $fields = array();
            foreach ( $this->get_fields() as $option ) {
                if ( isset( $option[ 'section' ] ) && $option[ 'section' ] == $section ) {
                    $fields[] = $option[ 'id' ];
                }
            }

            return $fields;
        }

        public function get_template_elements( $type, $return_default = true ) {

            if ( false === ( $order = get_transient( 'amphtml_template_blocks_order' ) ) ) {
                $order = get_option( 'amphtml_template_blocks_order' );
                $order = maybe_unserialize( $order );
                set_transient( 'amphtml_template_blocks_order', $order );
            }

            if ( isset( $order[ $type ] ) ) {
                return $order[ $type ];
            } else if ( $return_default ) {
                return $this->get_section_fields( $type );
            } else {
                return false;
            }
        }

        public function add_amphtml_init( $init ) {
            if ( isset( $init[ 'selector' ] ) && '#amphtml-custom-content' == $init[ 'selector' ] ) {
                $init[ 'init_instance_callback' ] = self::TINY_MCE_INIT_CALLBACK;
            }

            return $init;
        }

    }

}