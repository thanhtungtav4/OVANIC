<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( ! class_exists( 'AMPHTML_Tab_Analytics' ) ) {

    class AMPHTML_Tab_Analytics extends AMPHTML_Tab_Abstract {

        public function get_fields() {
            return array(
                array(
                    'id'                    => 'google_analytic',
                    'title'                 => __( 'Google Analytics Code', 'amphtml' ),
                    'placeholder'           => 'UA-XXXXXXXX-Y',
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'google_analytic' ),
                    'sanitize_callback'     => array( $this, 'sanitize_google_analytic' ),
                    'description'           => __( 'Setup Google Analytics tracking ID', 'amphtml' ),
                ),
                array(
                    'id'                    => 'google_tag_manager',
                    'title'                 => __( 'Google Tag Manager ID', 'amphtml' ),
                    'placeholder'           => 'GTM-XXXXXX',
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'google_tag_manager' ),
                    'sanitize_callback'     => array( $this, 'sanitize_google_tag_manager' ),
                    'description'           => __( 'Replacing GTM-XXXXXX with your container ID', 'amphtml' ),
                ),
                array(
                    'id'                    => 'yandex_metrika',
                    'title'                 => __( 'Yandex Metrika counter ID', 'amphtml' ),
                    'placeholder'           => 'XXXXXXXX',
                    'display_callback'      => array( $this, 'display_text_field' ),
                    'display_callback_args' => array( 'id' => 'yandex_metrika' ),
                    'sanitize_callback'     => array( $this, 'sanitize_yandex_metrika' ),
                    'description'           => __( 'Setup Yandex Metrika counter ID', 'amphtml' ),
                ),
                array(
                    'id'                    => 'facebook_pixel',
                    'title'                 => __( 'Facebook Pixel ID', 'amphtml' ),
                    'display_callback'      => array( $this, 'display_number_field' ),
                    'display_callback_args' => array( 'id' => 'facebook_pixel' ),
                    'sanitize_callback'     => array( $this, 'sanitize_number' ),
                    'description'           => __( 'Setup Facebook pixel ID', 'amphtml' ),
                ),
                array(
                    'id'                    => 'custom_analytic',
                    'title'                 => __( 'Custom Analytic', 'amphtml' ),
                    'display_callback'      => array( $this, 'display_textarea_field' ),
                    'display_callback_args' => array( 'id' => 'custom_analytic' ),
                    'sanitize_callback'     => array( $this, 'sanitize_custom_analytic' ),
                    'description'           => __( 'Put custom analytics code here', 'amphtml' ),
                ),
            );
        }

        public function display_number_field( $args ) {
            $this->display_text_field( $args, 'number' );
        }

        public function sanitize_google_tag_manager( $id ) {
            $id = sanitize_text_field( $id );
            if ( empty( $id ) ) {
                return '';
            }

            return strtoupper( $id );
        }

        public function sanitize_google_analytic( $google_analytics_id ) {
            $google_analytics_id = sanitize_text_field( $google_analytics_id );
            if ( empty( $google_analytics_id ) ) {
                return '';
            }
            if ( 0 === preg_match( "/^UA-([0-9]{4,9})-([0-9]{1,4})/i", $google_analytics_id ) ) {
                add_settings_error( $this->options->get( 'google_analytic', 'name' ), 'hc_error', __( 'Insert a valid Google Analytics ID', 'amphtml' ), 'error' );
                $valid_field = $this->options->get( 'google_analytic' );
            } else {
                $valid_field = $google_analytics_id;
            }

            return $valid_field;
        }

        public function sanitize_yandex_metrika( $counterId ) {
            $counterId = sanitize_text_field( $counterId );
            if ( empty( $counterId ) ) {
                return '';
            }
            if ( 0 === preg_match( "/([0-9]{6,8})/", $counterId ) ) {
                add_settings_error( $this->options->get( 'yandex_metrika', 'name' ), 'hc_error', __( 'Insert a valid counter ID', 'amphtml' ), 'error' );

                return $this->options->get( 'yandex_metrika' );
            }

            return $counterId;
        }

        public function sanitize_number( $val ) {
            $valid_field = $this->options->get( 'facebook_pixel' );
            $val         = sanitize_text_field( $val );
            if ( 0 === preg_match( '/^[0-9]+$|^$/', $val ) ) {
                add_settings_error( $this->options->get( 'facebook_pixel', 'name' ), 'cw_error', __( 'Insert a valid Pixel ID', 'amphtml' ), 'error' );
            } else {
                $valid_field = $val;
            }

            return $valid_field;
        }

        public function sanitize_custom_analytic( $content ) {
            global $option;
            $content = trim( $content );
            if ( empty( $content ) ) {
                return '';
            }
            $dom          = new DOMDocument;
            $dom->loadHTML( $content );
            $nodes        = $dom->getElementsByTagName( 'amp-analytics' );
            $is_incorrect = false;

            if ( $nodes->length == 0 ) {
                add_settings_error( $option, 'cw_error', 'Incorrect data for Custom Analytics Block Code', 'error' );
                $content = get_option( $option );
            } else {
                $node          = $nodes->item( 0 );
                $required_attr = array( 'type' );
                foreach ( $required_attr as $attr ) {
                    if ( ! $node->hasAttribute( $attr ) ) {
                        add_settings_error( $option, 'cw_error', "Attribute '$attr' is required.", 'error' );
                        $is_incorrect = true;
                    }
                }
                $content = $is_incorrect ? get_option( $option ) : $dom->saveHTML( $node );
            }

            return $content;
        }

    }

}