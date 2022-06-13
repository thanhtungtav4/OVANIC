<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_tags.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php

/**
 * @var $this AMPHTML_Template
 * @var $product WC_Product
 */
$tags = get_the_terms( $this->post->ID, 'product_tag' );
if ( ! empty( $tags ) ) {
    $tag_count = sizeof( $tags );
    echo get_the_term_list( $this->post->ID, 'product_tag', '<p class="amphtml-tagged-as">' . _n( 'Tag:', 'Tags:', $tag_count, 'amphtml' ) . ' ', ', ', '</p>' );
}