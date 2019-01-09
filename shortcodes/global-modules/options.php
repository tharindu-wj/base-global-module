<?php if (!defined('FW')) die('Forbidden');
$module_types = FW_Shortcode_Global_Modules::getModuleTypes();
$module_options = FW_Shortcode_Global_Modules::getModuleOptions();
//fw_print($module_types);
$options = array(

    'global_module' => array(
        'type' => 'multi-picker',
        'label' => false,
        'desc' => false,
        'value' => array(),
        'picker' => array(
            'module_type' => array(
                'label' => __('Choose Module Type', '{domain}'),
                'type' => 'select', // or 'short-select'
                'choices' => $module_types,
                'desc' => __('Select global module type', '{domain}'),
            )
        ),
        'choices' => $module_options,
        'show_borders' => true,
    ),
    'css_class' => array(
        'type' => 'text',
        'label' => __('CSS Class', 'fw'),
        'desc' => __('Add class to global wrapper', 'fw')
    ),
);