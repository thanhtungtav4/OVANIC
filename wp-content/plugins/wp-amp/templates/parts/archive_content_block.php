<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/archive_content_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php

if ( have_posts() ):
    while ( have_posts() ): the_post();
        $id = get_the_ID();
        $this->set_archive_page_post( $id );
        echo $this->render( 'loop-single' );
    endwhile;
endif;
?>