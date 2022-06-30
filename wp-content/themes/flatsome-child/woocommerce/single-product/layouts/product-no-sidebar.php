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
					<div class="shop_info">
						<ul>
							<li>
									<img src="<?php echo get_stylesheet_directory_uri() .'/assets/images/guarantee.png'?>">
									<p> Cam kết chính hãng 100% </p>
							</li>
							<li>
									<img src="<?php echo get_stylesheet_directory_uri() .'/assets/images/refund.png'?>">
									<p> Hoàn tiền 200% nếu phát hiện hàng giả </p>
							</li>
							<li>
									<img src="<?php echo get_stylesheet_directory_uri() .'/assets/images/box.png'?>">
									<p> Free ship đơn hàng từ 500k trở lên </p>
							</li>
						</ul>
					</div>
				</div>
    	</div>
    </div>
  </div>

  <div class="product-footer">
		<div class="container">
			<div class="row mb-0 content-row">
					<div class="large-9 col">
					<?php
    			/**
    			 * woocommerce_after_single_product_summary hook
    			 *
    			 * @hooked woocommerce_output_product_data_tabs
    			 */
    			do_action( 'woocommerce_tabs_display_custome' );
    		?>
					</div>
					<div class="large-4 col">

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
