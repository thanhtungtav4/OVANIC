<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/featured_image.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php

if ( $this->is_featured_image() ):
    echo $this->render_element( 'image', $this->featured_image );
 endif;