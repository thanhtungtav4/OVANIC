<?php
function hook_schema() {
    ?>
    <?php if(get_field('insert_headers', 'option')) :?>
        <?php
            $insert_headers = get_field('insert_headers', 'option');
            $formatted_schema_headers = str_replace(['<script type="application/ld+json">', '</script>', '<p>', '</p>'], '', $insert_headers);
	  print '<script type="application/ld+json">';	
            print $formatted_schema_headers;
            print '</script>';
        ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema_product') && is_product()) :?>
        <?php
            $schema_product = get_field('insert_schema_product');
            $formatted_schema = str_replace(['<script type="application/ld+json">', '</script>', '<p>', '</p>'], '', $schema_product);       
            print '<script type="application/ld+json">';	
            print $formatted_schema;           
            print '</script>';
        ?>
    <?php endif; ?>
    <?php if(get_field('insert_schema') && is_single() || is_page()) :?>
        <?php
            $schema_insert = get_field('insert_schema');
            $formatted_schema_insert = str_replace(['<script type="application/ld+json">', '</script>', '<p>', '</p>'], '', $schema_insert);
 	  print '<script type="application/ld+json">';	
            print $formatted_schema_insert;
	  print '</script>'
        ?>
    <?php endif; ?>
    <?php
}
add_action('wp_head', 'hook_schema');