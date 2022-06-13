<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/product_rating.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$rating_count = $product->get_rating_count();

if ( $rating_count > 0 ) :
    $rating = round( $product->get_average_rating() );
    ?>
    <p class="star">
        <?php
        for ( $i = 1; $i <= 5; $i ++ ):
            echo ( $rating >= $i ) ? '★' : '☆';
        endfor;
        ?>
    </p>
<?php endif; ?>