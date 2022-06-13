<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/search_title.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php if ( have_posts() ): ?>
    <h1 class="amphtml-title">
        <?php printf( __( 'Search Results for: %s', 'amphtml' ), '<span>' . get_search_query() . '</span>' ); ?>
    </h1>
<?php else: ?>
    <h1 class="amphtml-title"><?php _e( 'Nothing Found', 'amphtml' ); ?></h1>
<?php endif; ?>