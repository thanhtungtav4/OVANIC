<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<?php
	if ( get_theme_mod( 'product_upsell', 'sidebar' ) !== 'sidebar' ) :

		$type             = get_theme_mod( 'related_products', 'slider' );
		$repeater_classes = array();

		if ( $type == 'grid' ) {
			$type = 'row';
		}

		if ( get_theme_mod('category_force_image_height' ) ) $repeater_classes[] = 'has-equal-box-heights';
		if ( get_theme_mod('equalize_product_box' ) ) $repeater_classes[] = 'equalize-box';

		$repeater['type']         = 'sidebar';
		$repeater['columns']      = get_theme_mod( 'related_products_pr_row', 1 );
		$repeater['columns__md']  = get_theme_mod( 'related_products_pr_row_tablet', 1);
		$repeater['columns__sm']  = get_theme_mod( 'related_products_pr_row_mobile', 1 );
		$repeater['class']        = implode( ' ', $repeater_classes );
		$repeater['slider_style'] = 'reveal';
		$repeater['row_spacing']  = 'small';

		if ( count( $upsells ) < $repeater['columns'] ) {
			$repeater['type'] = 'row';
		}
		?>
		<aside class="widget widget-upsell">
			<?php
			$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'CÓ THỂ BẠN YÊU THÍCH', 'woocommerce' ) );

			if ( $heading ) :
				?>
				<h3 class="widget-title shop-sidebar">
					<?php echo esc_html( $heading ); ?>
				</h3>
			<?php endif; ?>
			<!-- Upsell List style -->
			<ul class="product_list_widget">
				<?php foreach ( $upsells as $upsell ) : ?>

					<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product-small' );
					?>

				<?php endforeach; ?>
			</ul>
		</aside>
	<?php else : ?>
		<aside class="widget widget-upsell">
			<?php
			$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

			if ( $heading ) :
				?>
				<h3 class="widget-title shop-sidebar">
					<?php echo esc_html( $heading ); ?>
					<div class="is-divider small"></div>
				</h3>
			<?php endif; ?>
			<!-- Upsell List style -->
			<ul class="product_list_widget">
				<?php foreach ( $upsells as $upsell ) : ?>

					<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product-small' );
					?>

				<?php endforeach; ?>
			</ul>
		</aside>

	<?php endif; ?>

	<?php
endif;

wp_reset_postdata();
