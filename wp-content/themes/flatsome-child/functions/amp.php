<?php
 function add_content_after_addtocart() {
    
    // get the current post/product ID
    $current_product_id = get_the_ID();

    // get the product based on the ID
    $product = wc_get_product( $current_product_id );

    // get the "Checkout Page" URL
    $checkout_url = WC()->cart->get_checkout_url();

    // run only on simple products
    if( $product->is_type( 'simple' ) ){
        echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'" class="a-button" style="background-color: #f1821f;">Mua Ngay</a>';
        //echo '<a href="'.$checkout_url.'" class="buy-now button">Buy Now</a>';
    }
}
add_action( 'woocommerce_after_add_to_cart_button_tungnt', 'add_content_after_addtocart' );
