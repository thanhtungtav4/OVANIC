<?php
/***
 * Disable Gutenberg with Code
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
/***
 * !Disable Gutenberg with Code
 */
/****
 * https://stackoverflow.com/questions/14396735/woocommerce-custom-price-range-in-url
 * https://gitlab.com/vncloudsco
 */
// Remove Wordpress Body Classes
add_filter('body_class','my_class_names');
function my_class_names($classes) {
    return array();
}

function hide_menu(){
    global $current_user;
    $user_id = get_current_user_id();
       if($user_id == '2'){
           remove_menu_page( 'edit.php?post_type=blocks' );    
           remove_menu_page( 'themes.php' );
           remove_menu_page( 'edit.php?post_type=featured_item' );
           remove_menu_page( 'edit.php?post_type=acf-field-group' );
           remove_menu_page('admin.php?page=wpseo_dashboard');
           remove_menu_page( 'getwooplugins' );
           remove_menu_page('tools.php');
           remove_menu_page('options-general.php');
           remove_menu_page('admin.php?page=theme-general-settings');
           remove_menu_page('plugins.php');
           remove_menu_page( 'woocommerce' );
           remove_menu_page('flatsome-panel');
           remove_menu_page('admin.php?page=yith_wfbt_panel');
           remove_menu_page( 'index.php' );
           remove_submenu_page( 'themes.php', 'themes.php' );
           remove_submenu_page( 'themes.php', 'theme-editor.php' );
           remove_submenu_page( 'themes.php', 'theme_options' );
           remove_menu_page( 'users.php' );
           remove_submenu_page( 'users.php', 'user-new.php' );
           remove_submenu_page( 'users.php', 'profile.php' );
           // Remove Comments Menu
           remove_menu_page( 'edit-comments.php' );
   
       }
   }
   
   
    add_action('admin_head', 'hide_menu');
   
   	// define the custom replacement callback
	function get_current_year() {
		return date('y');
	}
	
	function get_current_month() {
		return date('m');
	}

	// define the action for register yoast_variable replacments
	function register_custom_yoast_variables() {
		wpseo_register_var_replacement( '%%currentyear%%', 'get_current_year', 'advanced', 'some help text' );
		wpseo_register_var_replacement( '%%currentmonth%%', 'get_current_month', 'advanced', 'some help text' );
	}

	// Add action
	add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');