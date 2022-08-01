<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/wc_archives_image.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php $post_link = $this->get_amphtml_link( get_permalink() ); ?>
<?php if ( $this->options->get( 'wc_archives_link_image' ) ): ?>
    <a class="amphtml-product-thumb" href="<?php echo $post_link; ?>" title="<?php echo wp_kses_data( $this->title ); ?>">
    <?php endif; ?>
    <?php echo $this->render_element( 'image', $this->featured_image ); ?>
    <?php if ( $this->options->get( 'wc_archives_link_image' ) ): ?>
    </a>
<?php endif; ?>