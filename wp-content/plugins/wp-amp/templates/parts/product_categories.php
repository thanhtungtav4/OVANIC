<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_categories.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
$cats = get_the_terms( $this->post->ID, 'product_cat' );
if ( ! empty( $cats ) ) {
    $cat_count = sizeof( $cats );
    echo get_the_term_list( $this->post->ID, 'product_cat', '<p class="amphtml-posted-in">' . _n( 'Category:', 'Categories:', $cat_count, 'amphtml' ) . ' ', ', ', '</p>' );
}