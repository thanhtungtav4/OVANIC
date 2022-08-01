<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/blog_title.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<h1 class="amphtml-title"><?php echo esc_html( $this->options->get( 'blog_title' ) ) ?></h1>