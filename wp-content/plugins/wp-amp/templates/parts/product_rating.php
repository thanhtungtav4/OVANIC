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



if ( $rating_count > 0 ) :
    $rating = round( $product->get_average_rating() );
    ?>
    <p class="star">
        <?php
        for ( $i = 1; $i <= 5; $i ++ ):
            echo ( $rating >= $i ) ? '★' : '☆';
        endfor;
        ?>
        <a href="#reviews" class="woocommerce-review-link" rel="nofollow"> (đánh giá)</a>
    </p>
    
<?php endif; ?>