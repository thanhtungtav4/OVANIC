<?php
function hook_schema() {
    ?>
    <?php if(the_field('insert_headers', 'option')) :?>
        <?php echo the_field('insert_headers', 'option') ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema_product') && is_product()) :?>
        <?php echo the_field('insert_schema_product') ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema') && is_single() || is_page()) :?>
        <?php echo the_field('insert_schema') ?>
    <?php endif; ?>
    <?php
}
add_action('wp_head', 'hook_schema');