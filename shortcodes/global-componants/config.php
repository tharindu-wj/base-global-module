<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$cfg['page_builder'] = array(
    'title' 		=> __('Global Modules', 'fw'),
    'title_template' => '{{-title}}{{ if (o.section_title) { }} : <strong>{{= o.section_title}}</strong>{{ } }}',
    'description' 	=> __('Allows to chooses the blog posts and the layouts', 'fw'),
    'tab' 			=> __('Content Elements', 'fw'),
    'popup_size' 	=> 'large'
);