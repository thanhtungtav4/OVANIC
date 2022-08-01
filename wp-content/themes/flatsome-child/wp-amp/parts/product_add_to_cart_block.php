<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_add_to_cart_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<div class="clearfix" style="display: flex; align-items: center;">
    <p class="amphtml-price"style="">
        <?php if ( $this->get_option( 'product_price' ) ): ?>
            <span class="price"><?php echo $this->product->get_price_html(); ?></span>
        <?php endif; ?>
    </p>

    <?php if ( $this->get_option( 'product_add_to' ) ): ?>
        <?php AMPHTML_WC()->get_add_to_cart_button( false ); ?>
    <?php endif; ?>
    <?php if ( $this->get_option( 'product_price' ) ): ?>
        <p class="amphtml-add-to">
            <?php do_action('woocommerce_after_add_to_cart_button_tungnt') ?>
        </p>
    <?php endif; ?>
</div>