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
function add_script_fix_devgg(){ ?>
    <script>
 	jQuery.event.special.touchstart = {
		setup: function( _, ns, handle ) {
			this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
		}
	};
	jQuery.event.special.touchmove = {
		setup: function( _, ns, handle ) {
			this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
		}
	};
	jQuery.event.special.wheel = {
		setup: function( _, ns, handle ){
			this.addEventListener("wheel", handle, { passive: true });
		}
	};
	jQuery.event.special.mousewheel = {
		setup: function( _, ns, handle ){
			this.addEventListener("mousewheel", handle, { passive: true });
		}
	};
    </script>
  <?php 
}
add_action('wp_footer', 'add_script_fix_devgg');