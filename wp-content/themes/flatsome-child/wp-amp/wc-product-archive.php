<?php
/**
 * The Template for displaying WooCommerce Archive Pages
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/wc-product-archive.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
$view = $this->options->get( 'wc_archives_view' );
?>
<?php die(12121); ?>
<header class="page-header">
    <?php if ( $this->options->get( 'wc_archives_breadcrumbs' ) ): ?>
        <?php echo $this->render( 'breadcrumb' ); ?>
    <?php endif; ?>
    <h1 class="amphtml-title"><?php woocommerce_page_title(); ?></h1>
    <?php if ( $this->options->get( 'wc_archives_desc' ) ): ?>
        <?php echo term_description(); ?>
    <?php endif; ?>
    <?php if ( $this->options->get( 'wc_archives_original_btn_block' ) ): ?>
        <?php echo $this->render( 'original_btn_block' ); ?>
    <?php endif; ?>
    <?php if ( $this->options->get( 'wc_archives_search_form' ) ): ?>
        <?php echo $this->render( 'search_form' ); ?>
    <?php endif; ?>
    <?php if ( $this->options->get( 'wc_archives_sort_block' ) ): ?>
        <?php echo $this->render( 'sort_block' ); ?>
    <?php endif; ?>
</header>
<div class="products<?php if ( $view === 'grid' ): ?> products-grid<?php elseif ( $view === 'list' ): ?> products-list<?php else: ?> products-list_2<?php endif; ?>">
    <?php
    if ( have_posts() ):
        while ( have_posts() ): the_post();
            $id = get_the_ID();
            $this->set_archive_page_post( $id );
            if ( $view === 'list_2' ) {
                echo $this->render( 'wc-content-product-list-2' );
            } else {
                echo $this->render( 'wc-content-product' );
            }
        endwhile;
    endif;
    ?>
</div>
<?php echo $this->render( 'pagination' ) ?>