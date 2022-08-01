<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/related-posts.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */

$count          = $this->get_posts_count( 'related' );
$related        = $this->get_related_posts( $this->post, $count );
$show_thumbnail = $this->get_posts_thumbnail( 'related' );

if ( $related && $related->have_posts() ) :
    ?>
    <aside>
        <h3><?php echo $this->get_posts_title( 'related' ); ?></h3>
        <ul class="amphtml-recent-posts-list<?php echo $show_thumbnail ? ' show-thumbs' : '' ?>">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <?php $link = get_permalink( get_the_id() ); ?>
                <li>
                    <?php if ( $show_thumbnail && has_post_thumbnail( get_the_ID() ) ) : ?>
                        <a href="<?php echo $this->get_amphtml_link( $link ); ?>"
                           title="<?php the_title_attribute(); ?>">
                               <?php $this->the_post_thumbnail_tpl( get_the_ID() ); ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo $this->get_amphtml_link( $link ); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_title( '<h4>', '</h4>' ); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </aside>
    <?php
endif;
wp_reset_query();
