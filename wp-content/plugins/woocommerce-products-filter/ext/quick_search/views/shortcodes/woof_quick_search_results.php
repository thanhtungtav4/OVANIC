<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
$parse_tpl = explode("/", $data['template_result']);
if (count($parse_tpl) > 1 AND $parse_tpl[0] == 'custom') {
    $data['template_result'] = $parse_tpl[1];
}
?>
<div class="woof_quick_search_results" data-show_products="<?php esc_attr_e($data['always_show_products']) ?>" data-orderby="<?php esc_attr_e($data['orderby']) ?>" data-template_structure="<?php esc_attr_e($data['template_structure']) ?>" data-per_page="<?php esc_attr_e($data['per_page']) ?>" data-template="<?php esc_attr_e($data['template_result']) ?>">

</div>
<div style="display:none"class="woof_qs_templates woof_qs_templates_<?php esc_attr_e($data['template_result']) ?>">
    <?php
    

    if (count($parse_tpl) > 1 AND $parse_tpl[0] == 'custom') {
        echo woof()->render_html(get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'woof_qs_templates' . DIRECTORY_SEPARATOR . $parse_tpl[1] . DIRECTORY_SEPARATOR . 'output.php', $data);
    } else {
        echo woof()->render_html(WOOF_EXT_PATH . 'quick_search' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $parse_tpl[0] . DIRECTORY_SEPARATOR . 'output.php', $data);
    }
    ?>
</div>
