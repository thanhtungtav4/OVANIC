<div class="entry-content single-page">

	<?php the_content(); ?>

	<?php
	wp_link_pages();
	?>

	<?php if ( get_theme_mod( 'blog_share', 1 ) ) {
		// SHARE ICONS
		echo '<div class="blog-share text-center">';
		echo '<div class="is-divider medium"></div>';
		echo do_shortcode( '[share]' );
		echo '</div>';
	} ?>
</div>

<?php if ( get_theme_mod( 'blog_single_footer_meta', 1 ) ) : ?>
	<footer class="entry-meta text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' ); ?>">
		<?php
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'flatsome' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );


		// But this blog has loads of categories so we should probably display them here.
		if ( '' != $tag_list ) {
			$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'flatsome' );
		} else {
			$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'flatsome' );
		}

		printf( $meta_text, $category_list, $tag_list, get_permalink(), the_title_attribute( 'echo=0' ) );
		?>
	</footer>
<?php endif; ?>

<?php if ( get_theme_mod( 'blog_author_box', 1 ) ) : ?>
	<div class="entry-author author-box">
		<div class="flex-row align-top">
			<div class="flex-col mr circle">
				<div class="blog-author-image">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'flatsome_author_bio_avatar_size', 90 ) ); ?>
				</div>
			</div>
			<div class="flex-col flex-grow">
				<h5 class="author-name uppercase pt-half">
					<a href="<?php the_author_meta( 'user_url' ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
				</h5>
				<p class="author-desc small"><?php the_author_meta( 'description' ); ?></p>
				<div class="social-icons share-icons share-row relative">
					<a href="<?php the_author_meta( 'facebook' ); ?>" target="_blank" class="icon primary button circle tooltip facebook tooltipstered"><i class="icon-facebook"></i></a>
					<a href="<?php the_author_meta( 'twitter' ); ?>" target="_blank" class="icon primary button circle tooltip twitter tooltipstered"><i class="icon-twitter"></i></a>
					<a href="<?php the_author_meta( 'telegram' ); ?>" target="_blank" class="icon primary button circle tooltip telegram tooltipstered"><i class="icon-telegram"></i></a>
					<a href="<?php the_author_meta( 'youtube' ); ?>" target="_blank" class="icon primary button circle tooltip youtube tooltipstered"><i class="icon-youtube"></i></a>
					<a href="<?php the_author_meta( 'pinterest' ); ?>" target="_blank" class="icon primary button circle tooltip pinterest tooltipstered"><i class="icon-pinterest"></i></a>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( get_theme_mod( 'blog_single_next_prev_nav', 1 ) ) :
	flatsome_content_nav( 'nav-below' );
endif; ?>
