<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
$price_save =  $product->regular_price - $product->sale_price ;
?>

<div class="price-wrapper price-block">
	<p class="price_item is_price"> <strong>Giá:</strong> <span class="red"><?php echo(number_format($product->get_sale_price()) .'<sup>đ<sup>') ?></span> </p>
	<?php if($product->is_on_sale()) :?>
		<p class="price_item is_percentage"><strong> Tiết kiệm: </strong><span><span class="red"><?php print $percentage . '%' ?> </span> <span class="sale_value">(<?php echo number_format($price_save) .'<sup>đ<sup>' ?></span>)</span> </p>
		<p class="price_item is_sale "><strong> Giá thị trường: </strong><span class="price-on-sale"><?php echo(number_format($product->get_regular_price()) .'<sup>đ<sup>') ?> </span> </p>
	<?php endif ; ?>
</div>
