<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/no-form.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<p class='amp-no-form'>
    <?php _e( 'This page contains a form, you can see it', 'amphtml' ) ?>
    <a href="<?php echo get_the_permalink() ?>" target="_blank"><?php _e( 'here', 'amphtml' ) ?></a>
</p>