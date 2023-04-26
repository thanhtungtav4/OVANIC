<?php
/* Cleaner WP header
*===============================================================*/

function clean_header() {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Remove emoji js
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Remove EditURI/RSD + wlwmanifest + wp version
    remove_action ('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator'); 

}
add_action( 'init', 'clean_header' );

/* Remove Link rel=shortlink from http
*===============================================================*/
remove_action('template_redirect', 'wp_shortlink_header', 11);

/* Heartbeat API
*===============================================================*/
// function heartbeat( $settings ) {
//     $settings['interval'] = 120; //thay doi thoi gian chay
//     return $settings;
// }
//add_filter( 'heartbeat_settings', 'heartbeat' );


/* Disable xmlrpc_methods
*===============================================================*/
add_filter( 'xmlrpc_methods', 'block_xmlrpc_attacks' );
function block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
 
add_filter( 'wp_headers', 'remove_x_pingback_header' );
function remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

/* Chuyển định dạng Widget về dạng classic
*===============================================================*/
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

/* Tắt auto update của themes, plugins
*===============================================================*/
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

/* Tắt Lazyload trong WP 5.5
*===============================================================*/
add_filter('wp_lazy_loading_enabled', '__return_false');

/* Tắt wp-sitemap.xml WP 5.5
*===============================================================*/
add_filter( 'wp_sitemaps_enabled', '__return_false' );

/* Disable _application_passwords
*===============================================================*/
add_filter( 'wp_is_application_passwords_available', '__return_false' );

// /* /* Disable _application_passwords
// *===============================================================*/
// function remove_dashboard_widgets() {
//     global $wp_meta_boxes;
//   	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
//     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
//     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
//     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
// }
//add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


/* Remove ?ver=
*===============================================================*/
function wpex_remove_script_version( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'script_loader_src', 'wpex_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'wpex_remove_script_version', 15, 1 );

/* Disable RSS Feed
*===============================================================*/
function fb_disable_feed() {
wp_die( __('Website này đã tắt chức năng RSS. Vui lòng trở lại <a href="'. get_bloginfo('url') .'">Trang Chủ</a>!') );
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'fb_disable_feed', 1);
add_action('do_feed_atom_comments', 'fb_disable_feed', 1);

/* Add prefetch dns
*===============================================================*/
function add_prefetch_dns() {
	?>
		<link rel="dns-prefetch" href="//fonts.googleapis.com">
		<link rel="dns-prefetch" href="//www.google-analytics.com">
		<link rel="dns-prefetch" href="//www.googletagmanager.com">
		<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
		<link rel="dns-prefetch" href="//maps.googleapis.com">
		<link rel="dns-prefetch" href="//youtube.com">
		<link rel="dns-prefetch" href="//connect.facebook.net">
		<link rel="dns-prefetch" href="//www.facebook.com">
		<link rel="dns-prefetch" href="//static.xx.fbcdn.net">
	<?php
}
add_action('wp_head', 'add_prefetch_dns',100);


