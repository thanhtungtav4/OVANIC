<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( ! class_exists( 'AMPHTML_Tab_Appearance' ) ) {

    class AMPHTML_Tab_Appearance extends AMPHTML_Tab_Abstract {

        public function __construct( $name, $options, $is_current = false ) {
            parent::__construct( $name, $options, $is_current );
            add_action( 'amphtml_proceed_settings_form', array( $this, 'remove_outdated_min_css' ) );
        }

        public function get_fields() {
            return array_merge( $this->get_color_fields( 'colors' ), $this->get_font_fields( 'fonts' ), $this->get_header_fields( 'header' ), $this->get_footer_fields( 'footer' ), $this->get_post_meta_data_fields( 'post_meta_data' ), $this->get_social_share_buttons_fields( 'social_share_buttons' ), $this->get_social_buttons_fields( 'social_buttons' ), $this->get_extra_css_fields( 'extra_css' ) );
        }

        public function get_sections() {
            return array(
                'colors'               => __( 'Colors', 'amphtml' ),
                'fonts'                => __( 'Fonts', 'amphtml' ),
                'header'               => __( 'Header', 'amphtml' ),
                'footer'               => __( 'Footer', 'amphtml' ),
                'post_meta_data'       => __( 'Post Meta Data', 'amphtml' ),
                'social_share_buttons' => __( 'Social Share Buttons', 'amphtml' ),
                'social_buttons'       => __( 'Social Buttons', 'amphtml' ),
                'extra_css'            => __( 'Extra CSS', 'amphtml' )
            );
        }

        public function get_font_fields( $section ) {
            return array(
                array(
                    'id'                    => 'logo_font',
                    'title'                 => __( 'Logo', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'logo_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'menu_font',
                    'title'                 => __( 'Menu', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'menu_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'title_font',
                    'title'                 => __( 'Title', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'title_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'post_meta_font',
                    'title'                 => __( 'Post Meta', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'post_meta_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'content_font',
                    'title'                 => __( 'Content', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'content_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'footer_font',
                    'title'                 => __( 'Footer', 'amphtml' ),
                    'default'               => 'sans-serif',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_font_select' ),
                    'display_callback_args' => array( 'id' => 'footer_font' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'custom_fonts',
                    'title'                 => __( 'Custom Fonts', 'amphtml' ),
                    'default'               => '',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_custom_fonts' ),
                    'display_callback_args' => array( 'id' => 'custom_fonts' ),
                    'sanitize_callback'     => array( $this, 'sanitize_custom_fonts' ),
                    'description'           => '',
                ),
            );
        }

        public function get_color_fields( $section ) {
            $fields = array(
                array(
                    'id'                    => 'background_color',
                    'title'                 => __( 'Page Background', 'amphtml' ),
                    'default'               => '#FFFFFF',
                    'display_callback_args' => array( 'id' => 'background_color' ),
                ),
                array(
                    'id'                    => 'header_color',
                    'title'                 => __( 'Header Background', 'amphtml' ),
                    'default'               => '#ffffff',
                    'display_callback_args' => array( 'id' => 'header_color' ),
                ),
                array(
                    'id'                    => 'header_text_color',
                    'title'                 => __( 'Header Text', 'amphtml' ),
                    'default'               => '#8d447b',
                    'display_callback_args' => array( 'id' => 'header_text_color' ),
                ),
                array(
                    'id'                    => 'header_menu_color',
                    'title'                 => __( 'Header Menu Background', 'amphtml' ),
                    'default'               => '#8d447b',
                    'display_callback_args' => array( 'id' => 'header_menu_color' ),
                ),
                array(
                    'id'                    => 'header_menu_text_color',
                    'title'                 => __( 'Header Menu Text', 'amphtml' ),
                    'default'               => '#ffffff',
                    'display_callback_args' => array( 'id' => 'header_menu_text_color' ),
                ),
                array(
                    'id'                    => 'main_title_color',
                    'title'                 => __( 'Main Title', 'amphtml' ),
                    'default'               => '#88457b',
                    'display_callback_args' => array( 'id' => 'main_title_color' ),
                ),
                array(
                    'id'                    => 'main_text_color',
                    'title'                 => __( 'Main Text', 'amphtml' ),
                    'default'               => '#3d596d',
                    'display_callback_args' => array( 'id' => 'main_text_color' ),
                ),
                array(
                    'id'                    => 'link_color',
                    'title'                 => __( 'Link Text', 'amphtml' ),
                    'default'               => '#88457b',
                    'display_callback_args' => array( 'id' => 'link_color' ),
                ),
                array(
                    'id'                    => 'link_hover',
                    'title'                 => __( 'Link Hover', 'amphtml' ),
                    'default'               => '#2e4453',
                    'display_callback_args' => array( 'id' => 'link_hover' ),
                ),
                array(
                    'id'                    => 'inputs_color',
                    'title'                 => __( 'Inputs Color', 'amphtml' ),
                    'default'               => '#88457b',
                    'display_callback_args' => array( 'id' => 'inputs_color' ),
                ),
                array(
                    'id'                    => 'footer_text_color',
                    'title'                 => __( 'Footer Text', 'amphtml' ),
                    'default'               => '#FFFFFF',
                    'display_callback_args' => array( 'id' => 'footer_text_color' ),
                ),
                array(
                    'id'                    => 'footer_color',
                    'title'                 => __( 'Footer Background', 'amphtml' ),
                    'default'               => '#252525',
                    'display_callback_args' => array( 'id' => 'footer_color' ),
                ),
            );

            // set common options
            foreach ( $fields as &$field ) {
                $field[ 'display_callback' ]  = array( $this, 'display_color_field' );
                $field[ 'sanitize_callback' ] = array( $this, 'sanitize_color' );
                $field[ 'section' ]           = $section;
            }

            $fields = apply_filters( 'amphtml_color_fields', $fields, $this, $section );

            return $fields;
        }

        public function get_header_fields( $section ) {
            return array(
                array(
                    'id'                    => 'favicon',
                    'title'                 => __( 'Favicon', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_favicon' ),
                    'display_callback_args' => array( 'id' => 'favicon' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'header_menu',
                    'title'                 => __( 'Header Menu', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'header_menu' ),
                    'description'           => __( 'Show header menu', 'amphtml' ) . '(<a href="' . add_query_arg( array( 'action' => 'locations' ), admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . __( 'set AMP menu', 'amphtml' ) . '</a>)',
                ),
                array(
                    'id'                    => 'header_menu_type',
                    'title'                 => __( 'Header Menu Type', 'amphtml' ),
                    'default'               => 'accordion',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_header_menu_type' ),
                    'display_callback_args' => array(
                        'id'             => 'header_menu_type',
                        'select_options' => array(
                            'accordion' => 'Accordion',
                            'sidebar'   => 'Sidebar',
                        ) ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'header_menu_button',
                    'title'                 => __( 'Header Menu Button', 'amphtml' ),
                    'default'               => 'text',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_header_menu_button' ),
                    'display_callback_args' => array(
                        'id'             => 'header_menu_button',
                        'select_options' => array(
                            'text' => 'Text',
                            'icon' => 'Icon',
                        ) ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'logo_opt',
                    'title'                 => __( 'Logo Type', 'amphtml' ),
                    'default'               => 'text_logo',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_logo_opt' ),
                    'display_callback_args' => array( 'id' => 'logo_opt' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'logo_text',
                    'title'                 => __( 'Logo Text', 'amphtml' ),
                    'default'               => get_bloginfo( 'name' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'logo_text' ),
                    'description'           => '',
                ),
                array(
                    'id'                    => 'logo',
                    'title'                 => __( 'Logo Icon', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_logo' ),
                    'display_callback_args' => array( 'id' => 'logo' ),
                    'description'           => '',
                ),
            );
        }

        public function get_footer_fields( $section ) {
            return array(
                array(
                    'id'                    => 'footer_menu',
                    'title'                 => __( 'Footer Menu', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'footer_menu' ),
                    'description'           => __( 'Show footer menu', 'amphtml' ) . '(<a href="' . add_query_arg( array( 'action' => 'locations' ), admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . __( 'set footer AMP menu ', 'amphtml' ) . '</a>)',
                ),
                array(
                    'id'                    => 'footer_content',
                    'title'                 => __( 'Footer Content', 'amphtml' ),
                    'default'               => '',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_footer_content' ),
                    'display_callback_args' => array( 'id' => 'footer_content' ),
                    'sanitize_callback'     => array( $this, 'sanitize_footer_content' ),
                    'description'           => __( 'This is the footer content block for all AMP pages. <br>' . 'Leave empty to hide footer at all. <br>' . 'Plain html without inline styles allowed. ' . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' ),
                ),
                array(
                    'id'                    => 'footer_scrolltop',
                    'title'                 => __( 'Scroll to Top Button', 'amphtml' ),
                    'default'               => __( 'Back to top', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'footer_scrolltop' ),
                    'description'           => __( 'Leave empty to hide this button.', 'amphtml' ),
                ),
                array(
                    'id'                    => 'footer_social',
                    'title'                 => __( 'Social Buttons', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'footer_social' ),
                    'description'           => __( 'Show social button.', 'amphtml' ),
                ),
            );
        }

        public function get_post_meta_data_fields( $section ) {
            return array(
                array(
                    'id'                    => 'post_meta_author',
                    'title'                 => __( 'Author', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'post_meta_author' ),
                    'description'           => __( 'Show post author', 'amphtml' ),
                ),
                array(
                    'id'                    => 'post_meta_categories',
                    'title'                 => __( 'Categories', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'post_meta_categories' ),
                    'description'           => __( 'Show post categories', 'amphtml' ),
                ),
                array(
                    'id'                    => 'post_meta_tags',
                    'title'                 => __( 'Tags', 'amphtml' ),
                    'default'               => 1,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'post_meta_tags' ),
                    'description'           => __( 'Show post tags', 'amphtml' ),
                ),
                array(
                    'id'                    => 'post_meta_date_format',
                    'title'                 => __( 'Date Format', 'amphtml' ),
                    'default'               => 'default',
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_date_format' ),
                    'display_callback_args' => array( 'id' => 'post_meta_date_format' ),
                    'description'           => '(<a href="https://codex.wordpress.org/Formatting_Date_and_Time#Examples">Examples of Date Format</a>)',
                ),
            );
        }

        public function get_social_share_buttons_fields( $section ) {
            return array(
                array(
                    'id'                    => 'social_share_buttons',
                    'title'                 => __( 'Social Share Buttons', 'amphtml' ),
                    'default'               => array( 'facebook', 'twitter', 'linkedin' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_multiple_select' ),
                    'display_callback_args' => array(
                        'id'             => 'social_share_buttons',
                        'select_options' => array(
                            'facebook'  => __( 'Facebook', 'amphtml' ),
                            'twitter'   => __( 'Twitter', 'amphtml' ),
                            'linkedin'  => __( 'LinkedIn', 'amphtml' ),
                            'pinterest' => __( 'Pinterest', 'amphtml' ),
                            'whatsapp'  => __( 'WhatsApp', 'amphtml' ),
                            'email'     => __( 'Email', 'amphtml' ),
                        )
                    ),
                ),
                array(
                    'id'                    => 'social_like_button',
                    'title'                 => __( 'Facebook Like', 'amphtml' ),
                    'default'               => 0,
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_checkbox_field' ),
                    'display_callback_args' => array( 'id' => 'social_like_button' ),
                    'description'           => __( 'Show Facebook like button', 'amphtml' ),
                ),
            );
        }

        public function get_social_buttons_fields( $section ) {
            return array(
                array(
                    'id'                    => 'social_instagram',
                    'title'                 => __( 'Instagram', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_instagram' ),
                    'description'           => __( 'Instagram', 'amphtml' ),
                ),
                array(
                    'id'                    => 'social_facebook',
                    'title'                 => __( 'Facebook', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_facebook' ),
                    'description'           => __( 'Facebook', 'amphtml' ),
                ),
                array(
                    'id'                    => 'social_twitter',
                    'title'                 => __( 'Twitter', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_twitter' ),
                    'description'           => __( 'Twitter', 'amphtml' ),
                ),
                array(
                    'id'                    => 'social_linkedin',
                    'title'                 => __( 'LinkedIn', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_linkedin' ),
                    'description'           => __( 'LinkedIn', 'amphtml' ),
                ),
                array(
                    'id'                    => 'social_pinterest',
                    'title'                 => __( 'Pinterest', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_pinterest' ),
                    'description'           => __( 'Pinterest', 'amphtml' ),
                ),
                array(
                    'id'                    => 'social_youtube',
                    'title'                 => __( 'YouTube', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'social_youtube' ),
                    'description'           => __( 'YouTube', 'amphtml' ),
                ),
            );
        }

        public function get_extra_css_fields( $section ) {
            return array(
                array(
                    'id'                    => 'extra_css_amp',
                    'title'                 => __( 'Extra CSS', 'amphtml' ),
                    'placeholder'           => __( 'Enter Your CSS Code', 'amphtml' ),
                    'section'               => $section,
                    'display_callback'      => array( $this, 'display_textarea_field' ),
                    'display_callback_args' => array( 'id' => 'extra_css_amp' ),
                    'description'           => '',
                )
            );
        }

        /*
         * Color Section
         */

        public function sanitize_color( $color, $id = 'empty' ) {
            // Validate Color
            $background = trim( $color );
            $background = strip_tags( stripslashes( $background ) );

            // Check if is a valid hex color
            if ( false === $this->options->check_header_color( $background ) ) {
                add_settings_error( $this->options->get( $id, 'name' ), 'hc_error', __( 'Insert a valid color', 'amphtml' ), 'error' );
                $valid_field = $this->options->get( $id );
            } else {
                $valid_field = $background;
            }

            return $valid_field;
        }

        /*
         *  Font Section
         */

        public function get_fonts_list() {
            $fonts = array(
                'sans-serif',
                'Work Sans',
                'Alegreya',
                'Fira Sans',
                'Lora',
                'Merriweather',
                'Montserrat',
                'Open Sans',
                'Playfair Display',
                'Roboto',
                'Lato',
                'Cardo',
                'Arvo',
            );
            $fonts = array_merge( $fonts, $this->get_custom_font_name() );

            return $fonts;
        }

        public function get_custom_font_name() {

            $custom_font_name = array();

            $custom_fonts = $this->options->get( 'custom_fonts' );
            if ( ! empty( $custom_fonts ) ) {
                foreach ( $custom_fonts as $custom_font ) {
                    if ( ! empty( $custom_font[ 'name' ] ) && ( ! empty( $custom_font[ 'link' ] ) || ! empty( $custom_font[ 'link_bold' ] ) ) ) {
                        $custom_font_name[] = $custom_font[ 'name' ];
                    }
                }
            }
            return $custom_font_name;
        }

        public function display_font_select( $args ) {
            $id = $args[ 'id' ];
            ?>
            <label for="<?php echo $id ?>">
                <select style="width: 28%" id="<?php echo $id ?>" name="<?php echo $this->options->get( $id, 'name' ) ?>">
                    <?php foreach ( $this->get_fonts_list() as $title ): ?>
                        <?php $name = str_replace( ' ', '+', $title ) ?>
                        <option value="<?php echo $name ?>" <?php selected( $this->options->get( $id ), $name ) ?>>
                            <?php printf( __( '%s', 'amphtml' ), $title ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <?php
        }

        public function display_custom_fonts( $args ) {
            $id           = $args[ 'id' ];
            $custom_fonts = $this->options->get( $id );
            ?>
            <script type="text/x-template" id="amphtml-custom-font-tmpl">
                <fieldset id="custom-font-__N__" class="amphtml-custom-font" data-font="<?php _e( 'Font ', 'amphtml' ); ?> __N__">
                <legend><?php _e( 'Font ', 'amphtml' ); ?> __N__</legend>
                <p>
                <input  style="width: 28%" type="text" name="<?php echo $this->options->get( $id, 'name' ) ?>[__N__][name]"
                value="" placeholder="<?php _e( 'Font name ', 'amphtml' ); ?>" />
                </p>
                <p class="description"><?php _e( 'Font name', 'amphtml' ); ?></p>
                <br>
                <p>
                <input style="width: 28%" type="text" name="<?php echo $this->options->get( $id, 'name' ) ?>[__N__][link]"
                value="" placeholder="<?php _e( 'Font link', 'amphtml' ); ?>" />
                </p>
                <p class="description"><?php _e( 'Path to the font file (font-weight: regular)', 'amphtml' ); ?></p>
                <br>
                <p>
                <input style="width: 28%" type="text" name="<?php echo $this->options->get( $id, 'name' ) ?>[__N__][link_bold]"
                value="" placeholder="<?php _e( 'Bold Font link', 'amphtml' ); ?>" />
                </p>
                <p class="description"><?php _e( 'Path to the font file (font-weight: bold)', 'amphtml' ); ?></p>
                <br>
                <button class="button-link button-link-delete amphtml-delete-font" type="button"
                aria-label="<?php _e( 'Delete font', 'amphtml' ); ?>"><?php _e( 'Delete the font', 'amphtml' ); ?></button>
                </fieldset>
            </script>
            <?php
            if ( ! empty( $custom_fonts ) ) {
                $i = 0;
                foreach ( $custom_fonts as $custom_font ) {
                    if ( ! empty( $custom_font[ 'name' ] ) || ! empty( $custom_font[ 'link' ] ) ) {
                        $i ++;
                        ?>
                        <fieldset id="custom-font-<?php echo $i; ?>"
                                  class="amphtml-custom-font"
                                  data-font="<?php _e( 'Font ', 'amphtml' ); ?> __N__">
                            <legend><?php _e( 'Font ', 'amphtml' ); ?><?php echo $i; ?></legend>
                            <p>
                                <input  style="width: 28%" type="text"
                                        name="<?php echo $this->options->get( $id, 'name' ) ?>[<?php echo $i; ?>][name]"
                                        value="<?php echo esc_attr( $custom_font[ 'name' ] ); ?>"
                                        placeholder="<?php _e( 'Font name', 'amphtml' ); ?>" />
                            </p>
                            <p class="description"><?php _e( 'Font name', 'amphtml' ); ?></p>
                            <br>
                            <p>
                                <input style="width: 28%" type="text"
                                       name="<?php echo $this->options->get( $id, 'name' ) ?>[<?php echo $i; ?>][link]"
                                       value="<?php echo esc_attr( $custom_font[ 'link' ] ); ?>"
                                       placeholder="<?php _e( 'Font link', 'amphtml' ); ?>" />
                            </p>
                            <p class="description"><?php _e( 'Path to the font file (font-weight: regular)', 'amphtml' ); ?></p>
                            <br>
                            <p>
                                <input style="width: 28%" type="text"
                                       name="<?php echo $this->options->get( $id, 'name' ) ?>[<?php echo $i; ?>][link_bold]"
                                       value="<?php echo esc_attr( $custom_font[ 'link_bold' ] ); ?>"
                                       placeholder="<?php _e( 'Bold Font link', 'amphtml' ); ?>" />
                            </p>
                            <p class="description"><?php _e( 'Path to the font file (font-weight: bold)', 'amphtml' ); ?></p>
                            <br>
                            <button class="button-link button-link-delete amphtml-delete-font"
                                    type="button"
                                    aria-label="<?php _e( 'Delete the font', 'amphtml' ); ?>"><?php _e( 'Delete the font', 'amphtml' ); ?></button>
                        </fieldset>
                        <?php
                    }
                }
            }
            ?>
            <button id="amphtml-add-font" class="button button-secondary" type="button"><?php _e( 'Add font', 'amphtml' ); ?></button>
            <?php
        }

        /*
         *  Header Section
         */

        public function display_header_menu_type( $args ) {
            $this->display_select( $args );
        }

        public function display_header_menu_button( $args ) {
            $this->display_select( $args );
        }

        public function display_logo_opt( $args ) {
            $id = $args[ 'id' ];
            ?>
            <select style="width: 28%" id="<?php echo $id; ?>" name="<?php echo $this->options->get( $id, 'name' ) ?>">
                <option value="icon_logo" <?php selected( $this->options->get( $id ), 'icon_logo' ) ?>>
                    <?php _e( 'Icon Logo', 'amphtml' ); ?>
                </option>
                <option value="text_logo" <?php selected( $this->options->get( $id ), 'text_logo' ) ?>>
                    <?php _e( 'Text Logo', 'amphtml' ); ?>
                </option>
                <option value="icon_an_text" <?php selected( $this->options->get( $id ), 'icon_an_text' ) ?>>
                    <?php _e( 'Icon and Text Logo', 'amphtml' ); ?>
                </option>
                <option value="image_logo" <?php selected( $this->options->get( $id ), 'image_logo' ) ?>>
                    <?php _e( 'Image Logo', 'amphtml' ); ?>
                </option>
            </select>
            <?php
        }

        public function display_logo( $args ) {
            $id       = $args[ 'id' ];
            $logo_url = $this->get_img_url_by_option( $id );
            ?>
            <label for="upload_image">
                <p class="logo_preview hide_preview" <?php
                if ( ! $logo_url ): echo 'style="display:none"';
                endif;
                ?>>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php _e( 'Site Logo', 'amphtml' ) ?>"
                         style="width: auto; height: 100px">
                </p>
                <input class="upload_image" type="hidden" name="<?php echo $this->options->get( 'logo', 'name' ) ?>"
                       value="<?php echo esc_url( $logo_url ); ?>"/>
                <input class="upload_image_button button" type="button" value="<?php _e( 'Upload Image', 'amphtml' ) ?>"/>
                <input <?php
                if ( ! $logo_url ): echo 'style="display:none"';
                endif;
                ?>
                    class="reset_image_button button" type="button" value="<?php _e( 'Reset Image', 'amphtml' ) ?>"/>
                <p class="img_text_size_full"
                   style="display:none"><?php _e( 'The image will have full size.', 'amphtml' ) ?></p>
                <p class="img_text_size img_text_size_logo"><?php _e( 'The image will be resized to fit in a 32x32 box (but not cropped)', 'amphtml' ) ?></p>
            </label>
            <?php
        }

        public function display_favicon( $args ) {
            $id       = $args[ 'id' ];
            $logo_url = $this->get_img_url_by_option( $id );
            ?>
            <label for="upload_image">
                <p class="logo_preview" <?php
                if ( ! $logo_url ): echo 'style="display:none"';
                endif;
                ?>>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php _e( 'Site Favicon', 'amphtml' ) ?>"
                         style="width: auto; height: 100px">
                </p>
                <input class="upload_image" type="hidden" name="<?php echo $this->options->get( 'favicon', 'name' ) ?>"
                       value="<?php echo esc_url( $logo_url ); ?>"/>
                <input class="upload_image_button button" type="button" value="<?php _e( 'Upload Image', 'amphtml' ) ?>"/>
                <input <?php
                if ( ! $logo_url ): echo 'style="display:none"';
                endif;
                ?>
                    class="reset_image_button button" type="button" value="<?php _e( 'Reset Image', 'amphtml' ) ?>"/>
                <p class="img_text_size_full_favicon"><?php _e( 'The image will have full size.', 'amphtml' ) ?></p>
            </label>
            <?php
        }

        /*
         * Footer Section
         */

        public function sanitize_footer_content( $footer_content ) {
            $tags                           = wp_kses_allowed_html( 'post' );
            $tags[ 'form' ][ 'action-xhr' ] = true;

            $not_allowed = array(
                'font',
                'form',
                'menu',
                'nav'
            );

            foreach ( $tags as $key => $attr ) {
                if ( in_array( $key, $not_allowed ) ) {
                    unset( $tags[ $key ] );
                }
            }

            $tags = apply_filters( 'wpamp_content_tags', $tags );

            return wp_kses( $footer_content, $tags );
        }

        public function display_footer_content( $args ) {
            $id = $args[ 'id' ];
            ?>
            <textarea name="<?php echo $this->options->get( $id, 'name' ) ?>" rows="6"
                      cols="60"><?php echo trim( $this->options->get( $id ) ); ?></textarea>
                      <?php if ( $this->options->get( $id, 'description' ) ): ?>
                <p class="description"><?php _e( $this->options->get( $id, 'description' ), 'amphtml' ) ?></p>
                <?php
            endif;
        }

        public function display_date_format( $args ) {
            $id     = $args[ 'id' ];
            ?>
            <fieldset>
                <?php
                $custom = true;

                echo "\t<label><input type='radio' name='" . $this->options->get( $id, 'name' ) . "' value='none'";
                if ( 'none' === $this->options->get( $id ) ) {
                    echo " checked='checked'";
                    $custom = false;
                }
                echo ' /></span> ' . __( 'None', 'amphtml' ) . "</label><br />\n";


                echo "\t<label><input type='radio' name='" . $this->options->get( $id, 'name' ) . "' value='relative'";
                if ( 'relative' === $this->options->get( $id ) ) {
                    echo " checked='checked'";
                    $custom = false;
                }

                echo ' /> <span class="date-time-text format-i18n">' . esc_html( sprintf( _x( '%s ago', '%s = human-readable time difference', 'amphtml' ), human_time_diff( get_the_date() ) ) ) . '</span> (' . __( 'Relative', 'amphtml' ) . ")</label><br />\n";


                echo "\t<label><input type='radio' name='" . $this->options->get( $id, 'name' ) . "' value='default'";
                if ( 'default' === $this->options->get( $id ) ) {
                    echo " checked='checked'";
                    $custom = false;
                }
                echo ' /> <span class="date-time-text format-i18n">' . date_i18n( get_option( 'date_format' ) ) . '</span> (' . __( 'Default system format', 'amphtml' ) . ")</label><br />\n";

                $custom_value = strlen( get_option( 'amphtml_post_meta_date_format_custom' ) ) ? get_option( 'amphtml_post_meta_date_format_custom' ) : __( 'F j, Y', 'amphtml' );

                echo '<label><input type="radio" name="' . $this->options->get( $id, 'name' ) . '" id="date_format_custom_radio" value="custom"';
                checked( $custom );
                echo '/> <span class="date-time-text date-time-custom-text">' . __( 'Custom:', 'amphtml' ) . '</label>' . '<input type="text" name="amphtml_post_meta_date_format_custom" id="amphtml_date_format_custom" value="' . esc_attr( $custom_value ) . '" style="width:60px" /></span>' . '<span class="example">' . date_i18n( $custom_value ) . '</span>' . "<span class='spinner'></span>\n";
                ?>
                <span
                    class="description"><?php _e( $this->options->get( $id, 'description' ), 'amphtml' ) ?></span>
            </fieldset>
            <?php
        }

        public function get_submit() { //todo replace with action
            ?>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary"
                       value="<?php echo __( 'Save Changes', 'amphtml' ); ?>">
                       <?php if ( 'colors' == $this->get_current_section() ): ?>
                    <input type="submit" name="reset" id="reset" class="button"
                           value="<?php echo __( 'Default theme settings', 'amphtml' ); ?>" style="margin-left: 10px;">
                       <?php endif; ?>
            </p>
            <?php
        }

        public function display_textarea_field( $args ) {
            $id = $args[ 'id' ];
            ?>
            <textarea name="<?php echo $this->options->get( $id, 'name' ) ?>" id="amp_css_entry"
                      style="width:100%;height:300px;"
                      <?php echo ( $this->options->get( $id, 'placeholder' ) ) ? 'placeholder="' . $this->options->get( $id, 'placeholder' ) . '"' : '' ?>><?php echo esc_attr( $this->options->get( 'extra_css_amp' ) ); ?></textarea>
            <p class="description">
                <strong><?php _e( 'Important', 'amphtml' ); ?>: </strong><span><?php _e( 'Do not use disallowed styles for avoiding AMP validation errors.', 'amphtml' ); ?>
                    <?php _e( 'Please see', 'amphtml' ); ?>: <a
                        href="https://www.ampproject.org/docs/guides/responsive/style_pages" target="_blank">
                        <?php _e( 'Supported CSS', 'amphtml' ); ?></a>.</span>
            </p>
            <?php
        }

        public function remove_outdated_min_css( $options ) {
            if ( isset( $_REQUEST[ 'settings-updated' ] ) && 'true' == $_REQUEST[ 'settings-updated' ] && $this->is_current() ) {
                $styles   = array( 'style', 'rtl-style' );
                $template = new AMPHTML_Template( $options );
                foreach ( $styles as $filename ) {
                    if ( $path = $template->get_minify_style_path( $filename ) ) {
                        unlink( $path );
                    }
                    $template->generate_minified_css_file( $filename );
                }
            }
        }

        public function get_section_callback( $id ) {
            return array( $this, 'section_callback' );
        }

        public function section_callback( $page, $section ) {
            global $wp_settings_fields;

            $custom_fields = array(
                'logo_text',
            );

            if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
                return;
            }
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

                if ( in_array( $field[ 'id' ], $custom_fields ) ) {
                    echo "<tr{$class} style='display: none'>";
                } else {
                    echo "<tr data-name='{$field[ 'id' ]}' id='pos_{$row_id}' {$class}>";
                }

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