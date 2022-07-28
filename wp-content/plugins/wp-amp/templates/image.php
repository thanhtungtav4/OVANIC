<?php if( isset( $element[ 0 ] ) && ! empty( $element[ 'preload' ] ) ) : ?>
    <link rel="preload" as="image" href="<?php echo $element[ 0 ]; ?>" <?php echo $element[ 'srcset' ] ? sprintf( 'imagesrcset="%s"', esc_attr( $element[ 'srcset' ] ) ) : ''; ?> />
<?php endif; ?>
<?php
/**
 * The Template for render AMP HTML page images
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/image.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
if ( isset( $element[ 0 ] ) ):
    ?>
    <amp-img src="<?php echo $element[ 0 ] ?>" layout="responsive"
    <?php echo ( isset( $element[ 1 ] ) && $element[ 1 ] ) ? 'width="' . $element[ 1 ] . '"' : ''; ?>
    <?php echo ( isset( $element[ 2 ] ) && $element[ 2 ] ) ? 'height="' . $element[ 2 ] . '"' : ''; ?>
            <?php echo ! empty( $element[ 'alt' ] ) ? sprintf( 'alt="%s"', esc_attr( $element[ 'alt' ] ) ) : ''; ?>
            <?php echo ! empty( $element[ 'srcset' ] ) ? sprintf( 'srcset="%s"', esc_attr( $element[ 'srcset' ] ) ) : ''; ?>>
    </amp-img>
<?php endif; ?>