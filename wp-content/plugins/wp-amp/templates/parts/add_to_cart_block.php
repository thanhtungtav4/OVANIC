<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/add_to_cart_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php $section = $this->get_section();?>
<div class="clearfix">
    <?php if ( $this->get_option( $section . '_price' ) ): ?>
        <p class="amphtml-price"><?php woocommerce_template_loop_price(); ?></p>
    <?php endif; ?>

    <?php if ( $this->get_option( $section . '_add_to_cart' ) ): ?>
        <?php AMPHTML_WC()->get_add_to_cart_button(); ?>
    <?php endif; ?>
</div>