<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_short_desc.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php

$html = apply_filters( 'woocommerce_short_description', $this->post->post_excerpt );
echo $this->get_sanitize_obj()->sanitize_content( $html );
