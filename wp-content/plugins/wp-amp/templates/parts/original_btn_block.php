<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/original_btn_block.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
$url = $this->get_canonical_url();
if ( $this->options->get( 'mobile_amp' ) ) {
    $url = add_query_arg( array(
        'view-original-redirect' => '1',
    ), $url );
}
$section = $this->get_section();
?>
<div class="amp-button-holder">
    <a href="<?php echo $url ?>" class="amp-button"><?php echo __( $this->options->get( $section . '_original_btn_text' ), 'amphtml' ) ?></a>
</div>