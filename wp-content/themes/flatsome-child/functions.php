<?php
require_once( get_stylesheet_directory() . '/functions/init.php' );
require_once( get_stylesheet_directory() . '/functions/optimize.php' );
require_once( get_stylesheet_directory() . '/functions/taxonomy.php' );
require_once( get_stylesheet_directory() . '/functions/acf.php' );
//require_once( get_stylesheet_directory() . '/functions/woo.php' );
require_once( get_stylesheet_directory() . '/functions/url.php' );
require_once( get_stylesheet_directory() . '/functions/telegram.php' );
require_once( get_stylesheet_directory() . '/functions/style.php' );
require_once( get_stylesheet_directory() . '/functions/lang.php' );
require_once( get_stylesheet_directory() . '/functions/amp.php' );
require_once( get_stylesheet_directory() . '/functions/taxonomy-filter.php' );
require_once( get_stylesheet_directory() . '/functions/smtp.php' );
require_once( get_stylesheet_directory() . '/functions/schema.php' );
require_once( get_stylesheet_directory() . '/functions/blog.php' );

// Add custom Theme Functions here
define('THEME_PATH', get_stylesheet_directory());
//require_once(THEME_PATH . '/optimize-functions/global.php');
require_once(THEME_PATH . '/optimize-functions/remove-js-css.php');