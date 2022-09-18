<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dominhhai.com
 * @since      1.0.0
 *
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Flatsome_Utils_Mh
 * @subpackage Flatsome_Utils_Mh/public
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
class Flatsome_Utils_Mh_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'init', [$this, 'flatsome_untils_init'] );
		add_action( 'wp_footer', [$this, 'flatsome_untils_footer'] );
		
		add_action( 'wp_ajax_nopriv_flatsome_utils_mh_pagination', [$this, 'flatsome_utils_mh_pagination'] );
		add_action( 'wp_ajax_nopriv_flatsome_utils_mh_tabs', [$this, 'flatsome_utils_mh_tabs'] );
		add_action( 'wp_ajax_flatsome_utils_mh_tabs', [$this, 'flatsome_utils_mh_tabs'] );
		add_action( 'wp_ajax_flatsome_utils_mh_pagination', [$this, 'flatsome_utils_mh_pagination'] );

	}

	public function flatsome_utils_mh_pagination(){
		$ux_data = $_POST['ux_data'];
		if($ux_data['tag'] == 'ux_products_flatsome_utils')
			$data = ux_products_flatsome_utils($ux_data, '', 'ux_products_flatsome_utils');
		else if($ux_data['tag'] == 'blog_posts_flatsome_utils')
			$data = shortcode_latest_from_blog_flatsome_utils($ux_data, '', 'blog_posts_flatsome_utils');
		else
			$data = ($ux_data['tag'])($ux_data, '', $ux_data['tag']);
		echo json_encode(['success' => true, 'data' =>  $data]);
		die();
	}

	public function flatsome_utils_mh_tabs(){
		$sc = $_POST['sc'];
		$format_cs = str_replace('[--', '[', $sc);
		$format_cs = str_replace('--]', ']', $format_cs);
		$format_cs = str_replace('\"', '"', $format_cs);
		$data = do_shortcode( $format_cs );
		echo json_encode(['success' => true, 'data' =>  $data]);
		die();

	}
	public function flatsome_untils_footer(){
		
		include_once __DIR__ . '/partials/loading.php';
	}
	public function flatsome_untils_init(){
		require FLATSOME_UTILS_MH_PATH . '/inc/init.php';
		// print_r(get_flatsome_repeater_start($atts = []));
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flatsome-utils-mh-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_enqueue_script( $this->plugin_name . '-flickity', plugin_dir_url( __FILE__ ) . 'js/flickity.pkgd.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flatsome-utils-mh-public.js', array( 'jquery' ), $this->version, false );

	}

}
