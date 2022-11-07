<?php
function hook_schema() {
    ?>
    <?php if(get_field('insert_headers', 'option')) :?>
        <?php
            $insert_headers = get_field('insert_headers', 'option');
            $formatted_schema_headers = str_replace(['<p>', '</p>'], '', $insert_headers);
            print $formatted_schema_headers;
        ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema_product') && is_product()) :?>
        <?php
            $schema_product = get_field('insert_schema_product');
            $formatted_schema = str_replace(['<p>', '</p>'], '', $schema_product);
            print $formatted_schema;
        ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema') && is_single() || is_page()) :?>
        <?php
            $schema_insert = get_field('insert_schema');
            $formatted_schema_insert = str_replace(['<p>', '</p>'], '', $schema_insert);
            print $formatted_schema_insert;
        ?>
    <?php endif; ?>
    <?php
}
add_action('wp_head', 'hook_schema');