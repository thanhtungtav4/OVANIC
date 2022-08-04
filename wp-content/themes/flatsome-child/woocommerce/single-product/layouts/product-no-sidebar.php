<div class="product-container">
  <div class="product-main">
    <div class="row content-row mb-0">

    	<div class="product-gallery large-<?php echo flatsome_option('product_image_width'); ?> col">
    	<?php
    		/**
    		 * woocommerce_before_single_product_summary hook
    		 *
    		 * @hooked woocommerce_show_product_sale_flash - 10
    		 * @hooked woocommerce_show_product_images - 20
    		 */
    		do_action( 'woocommerce_before_single_product_summary' );
    	?>

			<p class='detail_info'>
				<?php echo the_field('cam_ket_san_pham', 'option'); ?>
			</p>

    	</div>

    	<div class="product-info summary col-fit col entry-summary <?php flatsome_product_summary_classes();?>">
				<?php
					do_action( 'woocommerce_single_title_module' );
    			?>
				<div class="shop_row">
					<div class="info">
						<?php
							/**
							 * woocommerce_single_product_summary hook
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>
					</div>
					<?php echo the_field('cam_ket_dich_vu', 'option'); ?>
				</div>
    	</div>
    </div>
  </div>

  <div class="product-footer">
		<div class="container">

		<div>
		<div class="container">
			<div class="row mb-0 content-row">
					<div class="large-8 col">
					<?php
					/**
					 *
					 * @hooked woocommerce_output_product_data_tabs
					 */
					do_action( 'woocommerce_tabs_display_custome' );
					?>
					</div>
					<div class="large-4 col">
						<div class="box_upsell">
						<?php
							do_action('woocommerce_upsell_display_custome');
						?>
						</div>
						<div class="stickybox">
							<div class="box_product">
								<p class="ttl"><?php echo get_the_title(); ?></p>
								<div class="box_product_inner">
									<?php do_action('get_brand_name') ?>
								</div>
							</div>
							<?php if( have_rows('post_increase_purchase_rate') ): ?>
							<ul>
							<?php while( have_rows('post_increase_purchase_rate') ): the_row();
								$name = get_sub_field('title');
								$url = get_sub_field('url');
								?>
									<li>
											<a href="<?php echo $url ?>" title="<?php echo $name ?>" target="_blank"><?php echo $name ?></a>
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5858 6.34317L12 4.92896L19.0711 12L12 19.0711L10.5858 17.6569L16.2427 12L10.5858 6.34317Z" fill="currentColor"/></svg>
									</li>
								<?php  endwhile; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>
			</div>
		</div>
  	<div class="container">
    		<?php
    			/**
    			 * woocommerce_after_single_product_summary hook
    			 *
    			 * @hooked woocommerce_upsell_display - 15
    			 * @hooked woocommerce_output_related_products - 20
    			 */
    			do_action( 'woocommerce_after_single_product_summary' );
    		?>
    </div>
  </div>
</div>
