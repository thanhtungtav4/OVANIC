<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
		$categories = get_categories();
	?>
	<ul class="m-categories flex-row container">
		<?php foreach($categories as $key=>$categorie) : ?>
			<li>
				<a href="<?php echo $categorie->slug; ?>" class="<?php $categorie->slug == getPrimary(get_the_ID())->slug ? print 'active' : ''?>">
					<?php echo $categorie->name ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">
		<?php
			if(flatsome_option('blog_post_style') == 'default' || flatsome_option('blog_post_style') == 'inline'){
				get_template_part('template-parts/posts/partials/entry-header', flatsome_option('blog_posts_header_style') );
			}
		?>
		<?php get_template_part( 'template-parts/posts/content', 'single' ); ?>
	</div>
</article>

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>