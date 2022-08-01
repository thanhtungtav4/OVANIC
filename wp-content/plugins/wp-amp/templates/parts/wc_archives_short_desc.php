<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/wc_archives_short_desc.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
$html = apply_filters( 'woocommerce_short_description', $this->post->post_excerpt );
?>
<div class="product-short-desc"><?php echo $this->get_sanitize_obj()->sanitize_content( $html ); ?></div>