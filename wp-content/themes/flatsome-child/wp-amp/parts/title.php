<?php
/**
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/title.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
if(is_product()) : ?>
<?php
$product = wc_get_product($this->post->ID);
$term_thuonghieu = get_the_terms( $this->post->ID, 'thuong-hieu' );
$pa_xuat_xu =  $product->get_attribute( 'pa_xuat-xu');
if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$rating_count = $product->get_rating_count();
if(get_field('is_product_top_selling') == true){
    $bestsale = "<span class='m-topsale' style='border-radius: 3px;background: #ff2114;margin-left: 8px;padding: 5px 10px;color: white;font-size: 13px;position: relative;top: -4px;'> Bán Chạy</span>";
}
?>
<p style="margin: 0 auto;background: #f2f2f2;padding: 10px 15px; border-radius: 10px; font-size: 14px; line-height: 1.7;">
    <?php echo the_field('cam_ket_san_pham', 'option'); ?>
</p>
<h1 class="amphtml-title" style="margin: 0.5rem auto"><?php echo $this->title ?> <?php echo $bestsale ?></h1>
<div class="m-list">
    <dl style="display: flex; flex-wrap: wrap; margin: 0;">
        <?php if($term_thuonghieu)  : ?>
            <dt style="margin-right: 10px; font-size: .8rem;">
                Thương hiệu : <a href="<?php echo site_url('/') .  $term_thuonghieu[0]->slug ?>"> <?php echo $term_thuonghieu[0]->name ?></a>
            </dt>
        <?php endif ; ?>
        <?php if($product->get_sku())  : ?>
            <dt style="margin-right: 10px; font-size: .8rem;">
                Mã sản phẩm : <span> <?php echo $product->get_sku() ?></span>
            </dt>
        <?php endif ; ?>
        <?php if($pa_xuat_xu)  : ?>
            <dt style="margin-right: 10px; font-size: .8rem;">
               Xuất xứ : <span> <?php echo $pa_xuat_xu ?></span>
            </dt>
        <?php endif ; ?>
        <?php if ( $rating_count > 0 ) :
        $rating = round( $product->get_average_rating() );
        ?>
        <dt class="star" style="margin-right: 10px; font-size: 1.2rem; margin-top: 0;">
            <?php
            for ( $i = 1; $i <= 5; $i ++ ):
                echo ( $rating >= $i ) ? '★' : '☆';
            endfor;
            ?>
            <a href="#comments" class="woocommerce-review-link" rel="nofollow" style="font-size: .7rem;"> (<?php echo $rating_count?> đánh giá)</a>
        </dt>

        <?php endif; ?>
        </dl>
</div>
<?php else :  ?>
    <h1 class="amphtml-title"><?php echo $this->title ?></h1>
<?php  endif;?>