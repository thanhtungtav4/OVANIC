<?php
/** 
 * This template can be overridden by copying it to yourtheme/wp-amp/parts/view_comments.php.
 *
 * @var $this AMPHTML_Template
 * @version 9.3.0
 */
?>
<?php
if ( comments_open() || get_comments_number() ) :
    wp_reset_query();
    ob_start();
    comments_template();
    $comments = ob_get_clean();
    echo $this->get_sanitize_obj()->sanitize_content( $comments );
endif;