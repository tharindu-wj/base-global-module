<?php

/*
 * @company name : Eight25Media
 * @authers : Tharindu Wickramasinghe
 * @date : 10/04/2018
 * @description : main class configurations for logo slider shortcode
 */

class FW_Shortcode_Global_Modules extends FW_Shortcode
{
    public static function getGlobalModules()
    {
        $args = array(
            'post_type' => 'global-module',
            'order' => 'ASC',
        );

        $the_query = new WP_Query($args);
        $modules = $the_query->posts;
        $option_arr = [];
        foreach ($modules as $module) {
            $option_arr[$module->ID] = $module->post_title;
        }

        return $option_arr;
    }

    public static function getGlobalModulesByTax($tax)
    {
        $args = array(
            'post_type' => 'global-module',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'module-types',
                    'terms' => $tax,
                    'field' => 'slug',
                    'include_children' => true,
                    'operator' => 'IN'
                )
            ),
        );

        $the_query = new WP_Query($args);
        $modules = $the_query->posts;
        $option_arr = [];
        foreach ($modules as $module) {
            $option_arr[$module->ID] = $module->post_title;
        }

        return $option_arr;
    }

    public static function getModuleTypes()
    {
        $terms = get_terms(array(
            'taxonomy' => 'module-types',
            'hide_empty' => true,
        ));

        $tax_arr['all'] = 'All';

        foreach ($terms as $term) {
            $tax_arr[$term->slug] = $term->name;
        }

        return $tax_arr;
    }

    public static function getModuleOptions()
    {
        $module_types = self::getModuleTypes();
        $option_arr['all'] = array(
            'module_id' => array(
                'label' => __('Module Name', '{domain}'),
                'type' => 'select', // or 'short-select'
                'choices' => self::getGlobalModules(),
                'desc' => __('Select module name to insert here', '{domain}'),
                'help' => __('Help tip', '{domain}'),
            ),
        );

        foreach ($module_types as $key => $value) {
            if ($key != 'all') {
                $option_arr[$key] = array(
                    'module_id' => array(
                        'label' => __('Module Name', '{domain}'),
                        'type' => 'select', // or 'short-select'
                        'choices' => self::getGlobalModulesByTax($value),
                        'desc' => __('Select module name to insert here', '{domain}'),
                        'help' => __('Help tip', '{domain}'),
                    ),
                );
            }
        }


        return $option_arr;
    }

}