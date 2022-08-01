<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/title_404.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<h1 class="amphtml-title">
    <?php printf( __( '%s', 'amphtml' ), $this->options->get( 'title_404' ) ); ?>
</h1>