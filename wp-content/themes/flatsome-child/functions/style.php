<?php
/***
 * add style to product detail page
 */
add_action('init', 'register_custom_styles_product');
function register_custom_styles_product() {
    wp_register_style( 'style_detail_product', get_stylesheet_directory_uri().'/assets/detail-product.css' );
}
add_action( 'wp_enqueue_scripts', 'conditionally_enqueue_styles_scripts' );
function conditionally_enqueue_styles_scripts() {
    if ( is_product() ) {
        wp_enqueue_style( 'style_detail_product' );
    }
    if(is_single()){
        wp_register_style( 'style_single', get_stylesheet_directory_uri().'/assets/detail-post.css' );
        wp_enqueue_style('style_single');
    }
}
//remove js css not using inhome
function wp_remove_scripts() {
    if (is_front_page() ) {
        // Remove Scripts
        wp_dequeue_script( 'masonry.pkgd' );
        wp_deregister_script( 'masonry.pkgd' );
        wp_dequeue_script( 'magnific-popup' );
        wp_deregister_script( 'magnific-popup' );
        wp_dequeue_style( 'magnific-popup' );
        wp_deregister_style('magnific-popup');
        wp_dequeue_style( 'devvn-shortcode-reviews' );
        wp_deregister_style( 'devvn-shortcode-reviews' );
        wp_dequeue_style( 'ion.range-slider' );
        wp_deregister_style( 'ion.range-slider' );
        wp_dequeue_style( 'shortcodes' );
        wp_deregister_style( 'shortcodes' );
        wp_dequeue_style( 'owl.carousel' );
        wp_deregister_style( 'owl.carousel' );
        wp_dequeue_style( 'devvn-post-comment' );
        wp_deregister_style( 'devvn-post-comment' );
        wp_dequeue_style( 'wc-memberships-frontend' );
        wp_deregister_style( 'wc-memberships-frontend' );
        wp_dequeue_style( 'automatewoo-referralsd' );
        wp_deregister_style( 'automatewoo-referrals' );
        }
    }
add_action( 'wp_enqueue_scripts', 'wp_remove_scripts', 999 );
function wp_remove_scripts_head() {
    if (is_front_page() ) {
        // Remove Scripts
        wp_dequeue_style( 'devvn-shortcode-reviews' );
        wp_deregister_style( 'devvn-shortcode-reviews' );
    }
}
add_action( 'wp_head', 'wp_remove_scripts_head', 9999 );
