<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/pagination.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<div id="pagination">
    <div class="prev"><?php previous_posts_link( '<i class="icon-arrow-left"></i>' . __( 'Previous', 'amphtml' ) ); ?></div>
    <div class="next"><?php next_posts_link( __( 'Next', 'amphtml' ) . '<i class="icon-arrow-right"></i>', 0 ) ?></div>
</div>