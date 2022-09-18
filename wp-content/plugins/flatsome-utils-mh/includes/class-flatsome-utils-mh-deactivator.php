<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://dominhhai.com
 * @since      1.0.0
 *
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/includes
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
class Flatsome_Utils_Mh_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// get_template_directory();
		// $source = file_get_contents(get_template_directory() . '/inc/init.php');
		// $init = file_get_contents(FLATSOME_UTILS_MH_PATH . 'inc/override/init.php');
		// $source =  str_replace($init, '', $source);
		// $destination = get_template_directory() . '/inc/init.php';
		// file_put_contents($destination, $source);

		// $source = file_get_contents(FLATSOME_UTILS_MH_PATH . 'inc/builder/deactive.php');
		// $destination = get_template_directory() . '/inc/builder/shortcodes.php';
		// file_put_contents($destination, $source);
	}

}
