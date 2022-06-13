<?php if( ! empty( $element[ 'preload_images' ] ) ) : ?>
    <?php echo $element[ 'preload_images' ] ?>
<?php endif; ?>
<?php
/**
 * The Template for displaying AMP HTML carousel component
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/carousel.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
if ( isset( $element ) ):
    ?>
    <amp-carousel type="slides" layout="responsive" controls width="<?php echo $element[ 'width' ] ?>"
                  height="<?php echo $element[ 'height' ] ?>">
                      <?php echo $element[ 'images' ] ?>
    </amp-carousel>
<?php endif; ?>