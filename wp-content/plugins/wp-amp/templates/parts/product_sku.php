<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_sku.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php if ( $this->product->get_sku() ): ?>
    <small class="amphtml-sku"><?php _e( 'SKU', 'amphtml' ) ?>: <?php echo $this->product->get_sku() ?></small>
<?php endif; ?>