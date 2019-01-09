<?php if (!defined('FW')) die('Forbidden');

$shortcodes_extension = fw_ext('resources');
$base_statics = '/shortcodes/resources/static/';

wp_enqueue_script(
    'fw-shortcode-resources-script',
    $shortcodes_extension->get_uri($base_statics.'/js/scripts.js')
);

wp_enqueue_style(
    'fw-shortcode-resources-style',
    $shortcodes_extension->get_uri($base_statics.'/css/styles.css')
);

wp_enqueue_style(
    'fw-shortcode-quote-with-video-slider-style',
    $shortcodes_extension->get_uri($base_statics . '/css/jquery.fancybox.min.css')
);

wp_enqueue_script(
    'fw-fancybox-script',
    $shortcodes_extension->get_uri($base_statics . '/js/jquery.fancybox.min.js')
);

wp_enqueue_style(
    'jquery-ui',
    $shortcodes_extension->get_uri($base_statics.'/css/jquery-ui.min.css')
);

wp_enqueue_script(
    'jquery-ui',
    $shortcodes_extension->get_uri($base_statics . '/js/jquery-ui.min.js')
);