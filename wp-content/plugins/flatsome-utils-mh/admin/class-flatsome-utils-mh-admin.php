<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dominhhai.com
 * @since      1.0.0
 *
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/admin
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
class Flatsome_Utils_Mh_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', [$this, 'fl_util_settings']);
		 
		new FSUT_Ajax_Admin();
		
	}

	public function fl_util_settings() {
		    add_submenu_page(
		        'tools.php',
		        'Flatsome Utils Settings',
		        'Flatsome Utils Settings',
		        'manage_options',
		        'flatsome-utils',
		        [$this, 'fl_util_settings_callback'] );
	}

	public function fl_util_settings_callback() {
	    include_once __DIR__ . '/partials/flatsome-utils-mh-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flatsome_Utils_Mh_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flatsome_Utils_Mh_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flatsome-utils-mh-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flatsome_Utils_Mh_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flatsome_Utils_Mh_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flatsome-utils-mh-admin.js', array( 'jquery' ), $this->version, false );

	}

}
