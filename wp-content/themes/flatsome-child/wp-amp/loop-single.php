<?php
/**
 * The Template for render AMP HTML page loop content
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/loop-single.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
global $post;
$post_link = $this->get_amphtml_link( get_permalink() );
$section   = $this->get_section();
?>
<div class="amphtml-content">
    <h2 class="amphtml-title">
        <a href="<?php echo $post_link; ?>"
           title="<?php echo wp_kses_data( $this->title ); ?>">
               <?php echo wp_kses_data( $this->title ); ?>
        </a>
    </h2>
    <?php if ( $this->is_featured_image() ): ?>
        <?php if ( $this->options->get( $section . '_featured_image_link' ) ): ?>
            <a href="<?php echo $post_link; ?>" title="<?php echo wp_kses_data( $this->title ); ?>">
            <?php endif; ?>
            <?php echo $this->render_element( 'image', $this->featured_image ) ?>
            <?php if ( $this->options->get( $section . '_featured_image_link' ) ): ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ( $this->is_enabled_meta() ): ?>
        <ul class="amphtml-meta">
            <?php echo $this->get_post_meta() ?>
        </ul>
    <?php endif; ?>
    <?php if ( $this->is_enabled_excerpt() ): ?>
        <div class="amphtml-post-excerpt">
            <?php echo $this->get_archive_page_description(); ?>
        </div>
    <?php endif; ?>
</div>