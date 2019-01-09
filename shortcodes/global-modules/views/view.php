<?php
/**
 * @vars
 */
$module_type = $atts['global_module']['module_type'];
$module_id = $atts['global_module'][$module_type]['module_id'];
$css_class = $atts['css_class'];
$content = get_post_meta($module_id, 'global_content_meta', true);
?>

<div class="base-global-wrapper<?php if(!empty($css_class)){echo " ".$css_class;} ?>">
    <?php echo do_shortcode($content); ?>
</div>


