<h6 class="entry-category is-xsmall">
	<?php echo get_the_category_list( __( ', ', 'flatsome' ) ) ?>
</h6>

<?php
if ( is_single() ) {
	echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
} else {
	echo '<h2 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark" class="plain">' . get_the_title() . '</a></h2>';
}
?>

<div class="entry-divider is-divider small"></div>

<?php
$single_post = is_singular( 'post' );
if ( $single_post && get_theme_mod( 'blog_single_header_meta', 1 ) ) : ?>
	<div class="entry-meta uppercase is-xsmall flex-entry-meta">
		<p>
			Bởi
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author external" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
		</p>
		<?php if(get_field('tham_van_y_khoa')) :
					$id_user = get_field('tham_van_y_khoa');
					$name_user = get_user_by('id', $id_user)->data->display_name;
					$url_user = get_author_posts_url($id_user);
			?>
		<p>
			Tham vấn y khoa -
			<a href="<?php echo $url_user ?>" rel="author external" title="<?php echo $name_user; ?>">
			 <?php echo $name_user; ?>
			</a>
		</p>
		<p>
			- <?php echo get_the_date() ?>
		</p>
		<?php //flatsome_posted_on(); ?>
	</div>
	<?php endif; ?>
<?php elseif ( ! $single_post && 'post' == get_post_type() ) : ?>
	<div class="entry-meta uppercase is-xsmall">
		<?php flatsome_posted_on(); ?>
	</div>
<?php endif; ?>
		</p>
