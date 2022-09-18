<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dominhhai.com
 * @since             1.6
 * @package           Flatsome_Utils_Mh
 *
 * @wordpress-plugin
 * Plugin Name:       Flatsome-Utils-MH
 * Plugin URI:        flatsome-utils-mh
 * Description:       Uxbuilder Nâng Cao cho Flatsome.
 * Version:           1.6
 * Author:            Đỗ Minh Hải
 * Author URI:        https://dominhhai.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flatsome-utils-mh
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FLATSOME_UTILS_MH_VERSION', '1.6' );
define( 'FLATSOME_UTILS_MH_PATH', plugin_dir_path( __FILE__ ) );
define( 'FLATSOME_UTILS_MH_URL', plugin_dir_url( __FILE__ ) );

if(!function_exists('debug')){
	function debug($v, $die = true){
		echo "<pre>";
		print_r($v);
		echo "</pre>";
		if($die)
			die();

	}
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flatsome-utils-mh-activator.php
 */
function activate_flatsome_utils_mh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flatsome-utils-mh-activator.php';
	Flatsome_Utils_Mh_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flatsome-utils-mh-deactivator.php
 */
function deactivate_flatsome_utils_mh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flatsome-utils-mh-deactivator.php';
	Flatsome_Utils_Mh_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_flatsome_utils_mh' );
register_deactivation_hook( __FILE__, 'deactivate_flatsome_utils_mh' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

include_once "helpers/functions.php";
include_once "admin/ajax-admin.php";

require plugin_dir_path( __FILE__ ) . 'includes/class-flatsome-utils-mh.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function flatsome_utils_override_($file, $content){
	file_put_contents($file, $content);

}
function run_flatsome_utils_mh() {

	
	

	$plugin = new Flatsome_Utils_Mh();
	$plugin->run();

}
run_flatsome_utils_mh();
