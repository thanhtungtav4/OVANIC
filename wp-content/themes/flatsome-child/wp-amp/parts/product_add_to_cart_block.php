<?php
/**
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_add_to_cart_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
$this->add_embedded_element( array(
    'slug' => 'amp-form',
    'src'  => 'https://cdn.ampproject.org/v0/amp-form-0.1.js'
) );
?>
<div class="clearfix" >
    <p class="amphtml-price">
        <?php if ( $this->get_option( 'product_price' ) ): ?>
            <span class="price"><?php echo $this->product->get_price_html(); ?></span>
        <?php endif; ?>
    </p>
</div>
<div class="clearfix" style="display: flex;align-items: center;justify-content: space-around;position: fixed;bottom: 0;padding: 0 0 10px;background-color: white;z-index: 99;left: 0;right: 0;">
    <?php if ( $this->get_option( 'product_add_to' ) ): ?>
        <?php AMPHTML_WC()->get_add_to_cart_button( false ); ?>
    <?php endif; ?>
    <?php if ( $this->get_option( 'product_price' ) ): ?>
        <p class="amphtml-add-to">
            <?php do_action('woocommerce_after_add_to_cart_button_tungnt') ?>
        </p>
    <?php endif; ?>
</div>
<?php
    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
?>
<?php echo the_field('thong_tin_uu_dai', 'option'); ?>
<p style="margin: 0 auto;background: #f2f2f2;padding: 10px 15px; border-radius: 10px; font-size: 14px; line-height: 1.7;">
🔎 Tìm trên Google <strong>"Tên sản phẩm + Ovanic"</strong> để mua sản phẩm chính hãng nhanh nhất nhé!    
</p>