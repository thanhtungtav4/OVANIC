<?php 
	class FSUT_Ajax_Admin {

		
		public function __construct(){


			//check Permission
			
			
			$this->ajax_admin();
			$this->ajax_no_priv();
		}


		public function ajax_admin()
		{
			$ajaxs = [
				//Options
				'fsut_get_option'				=> 'fsut_get_option',
				'fsut_save_option'				=> 'fsut_save_option',
				'fsut_remove_cpt'				=> 'fsut_remove_cpt',
				'fsut_generate_custom_post_type'				=> 'fsut_generate_custom_post_type',

			
				
			];
			
			if($ajaxs){
				foreach ($ajaxs as $k => $v) {
					add_action( 'wp_ajax_'. $v, [$this, $v]);
				}
				
			}
		}
		
		
		public function ajax_no_priv()
		{
			
			$ajaxs = [
				'fsut_init_campaign' => 'fsut_init_campaign'
			]; 

			if($ajaxs){
				foreach ($ajaxs as $k => $v) {
					add_action( 'wp_ajax_'. $v, [$this, $v]);
					add_action( 'wp_ajax_nopriv_'. $v, [$this, $v]);
				}

			}

		}

		public function fsut_remove_cpt(){

		}

		public function fsut_generate_custom_post_type(){
			if(!current_user_can('administrator'))
				return;

			$data = isset($_POST['data']) ? $_POST['data'] : '';

			$this->remove_all_cpt();
			if($data){
				foreach($data as $cpt){
					if(!$cpt['post_type'] || !$cpt['ux_name'] || !$cpt['category'])
						continue;


					
					$builder_file = "custom_{$cpt['post_type']}_posts_flatsome_utils.php";
					$shortcode_file = 	"custom_{$cpt['post_type']}_posts_flatsome_utils.php";

					$builder = file_get_contents(FLATSOME_UTILS_MH_PATH . '/inc/builder/shortcodes/blog_posts_flatsome_utils.php');
					$shortcode = file_get_contents(FLATSOME_UTILS_MH_PATH . '/inc/shortcodes/blog_posts_flatsome_utils_template.php');

					$builder_replace = [
						"\$repeater_post_type = 'post';" => "\$repeater_post_type = '{$cpt['post_type']}';",
						"\$repeater_post_cat = 'category';" => "\$repeater_post_cat = '{$cpt['category']}';",
						"blog_posts_flatsome_utils" => "custom_{$cpt['post_type']}_posts_flatsome_utils",
						"Blog posts Flatsome Utils" => $cpt['ux_name'],

					];

					foreach ($builder_replace as $key => $r) {
						$builder = str_replace($key, $r, $builder);
					}

					$shortcode_replace = [
						"shortcode_latest_from_blog_flatsome_utils" => "custom_{$cpt['post_type']}_posts_flatsome_utils",
						"'post_type' => 'post'," => "'post_type' => '{$cpt['post_type']}',",
						"blog_posts_flatsome_utils" => "custom_{$cpt['post_type']}_posts_flatsome_utils",
						"'taxonomy' => 'category'," => "'taxonomy' => '{$cpt['category']}',",

					];
					foreach ($shortcode_replace as $key => $r) {
						$shortcode = str_replace($key, $r, $shortcode);
					}

					// if(!file_exists(FLATSOME_UTILS_MH_PATH . '/inc/builder/shortcodes/' . $builder_file))
						file_put_contents(FLATSOME_UTILS_MH_PATH . '/inc/builder/shortcodes/' . $builder_file, $builder);
					// if(!file_exists(FLATSOME_UTILS_MH_PATH . '/inc/shortcodes/' . $shortcode_file))
						file_put_contents(FLATSOME_UTILS_MH_PATH . '/inc/shortcodes/' . $shortcode_file, $shortcode);


				}
			}

			MH_Response(true, $data);
		}

		public function remove_all_cpt(){
			$shortcodes = FSUT_getDirContents(FLATSOME_UTILS_MH_PATH . '/inc/shortcodes/');
			foreach ($shortcodes as $key => $value) {
				if(strpos($value, 'custom_') !== false)
					unlink($value);
			}

			$builders = FSUT_getDirContents(FLATSOME_UTILS_MH_PATH . '/inc/builder/shortcodes/');
			foreach ($builders as $key => $value) {
				if(strpos($value, 'custom_') !== false)
					unlink($value);
			}
		}

		//For Admin Only

		public function fsut_get_option($key = '')
		{
			if($key == '')
				$key = $_POST['key'];
			$data = get_option($key, false);
			echo json_encode(['success' => 1, 'msg' => 'Thành công!', 'data' => $data ? json_decode($data) : null]);
			die();
		}

		public function fsut_save_option($key = '', $data = '')
		{
			if(!current_user_can('administrator'))
				return;

			$data = $_POST['data'];
			$key = $_POST['key'];
			if(!$data || !$key)
			{
				echo json_encode(['success' => 0, 'msg' => 'Có lỗi xảy ra!']);
				die();
			}

			$option = get_option($key, false);
			if( $option ) {
				update_option($key, json_encode($data));
			}else {
			
				add_option( $key, json_encode($data));
			}
			$data = get_option($key, false);
			echo json_encode(['success' => 1, 'msg' => 'Lưu dữ liệu thành công!', 'data' => json_decode($data)]);
			die();
		}

	
}