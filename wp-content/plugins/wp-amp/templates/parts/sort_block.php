<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/sort_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
$section = $this->get_section();

$catalog_orderby_options = array(
    'menu_order' => __( 'Default sorting', 'woocommerce' ),
);
if ( $this->options->get( $section . '_popularity' ) ) {
    $catalog_orderby_options[ 'popularity' ] = __( 'Sort by popularity', 'woocommerce' );
}
if ( $this->options->get( $section . '_average_rating' ) ) {
    $catalog_orderby_options[ 'rating' ] = __( 'Sort by average rating', 'woocommerce' );
}
if ( $this->options->get( $section . '_date' ) ) {
    $catalog_orderby_options[ 'date' ] = __( 'Sort by latest', 'woocommerce' );
}
if ( $this->options->get( $section . '_price_asc' ) ) {
    $catalog_orderby_options[ 'price' ] = __( 'Sort by price: low to high', 'woocommerce' );
}
if ( $this->options->get( $section . '_price_desc' ) ) {
    $catalog_orderby_options[ 'price-desc' ] = __( 'Sort by price: high to low', 'woocommerce' );
}
?>

<form class="woocommerce-ordering" action="<?php echo $current_url; ?>" target="_top" method="get">
    <select name="orderby" class="orderby">
        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
            <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="paged" value="1" />
    <input class="i-button" type="submit" value="<?php _e( 'Sort', 'amphtml' ); ?>"/>
    <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>

