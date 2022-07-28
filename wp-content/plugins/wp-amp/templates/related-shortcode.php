<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/related-shortcode.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */

$posts          = $this->get_related_posts( $this->post, $this->related_atts[ 'count' ] );
$show_thumbnail = $this->recent_atts[ 'image' ] != 'hide';

if ( $posts && $posts->have_posts() ) :
    ?>
    <aside>
        <h3><?php echo $this->related_atts[ 'title' ] ?></h3>
        <ul class="amphtml-recent-posts-list<?php echo $show_thumbnail ? ' show-thumbs' : '' ?>">
            <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
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
