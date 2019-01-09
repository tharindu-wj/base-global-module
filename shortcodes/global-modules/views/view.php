<?php
$module_type = $atts['global_module']['module_type'];
$module_id = $atts['global_module'][$module_type]['module_id'];

$content = get_post_meta($module_id, 'global_content_meta', true);
?>

<div class="base-global-wrapper">
    <?php echo do_shortcode($content); ?>
</div>


