<?php
if (!defined('FW')) die('Forbidden');

class FW_Extension_Global_Module extends FW_Extension
{
    /**
     * @internal
     */
    public function _init()
    {
        $this->add_admin_filters();
    }

    public function add_admin_filters()
    {
        add_filter('fw_post_options', array($this, '_filter_admin_add_post_options'), 10, 2);
    }

    public function _filter_admin_add_post_options($options, $post_type)
    {
        //$options = '';
        if ($post_type === 'global-module') {
            $options[] = array(
                'common' => array(
                    'title' => __('Global Module Content', 'fw'),
                    'type' => 'box',
                    'options' => array(
                        'common_tab' => array(
                            'type' => 'tab',
                            'title' => __('Content', 'fw'),
                            'options' => array(
                                'global_content' => array(
                                    'type'   => 'wp-editor',
                                    'label'  => false,
                                    'desc'   => __( 'Add unyson shortcodes or normal post content to store as project global.', 'fw' ),
                                    'size' => 'large',
                                    'wpautop' => false,
                                    'editor_height' => 400,
                                    'shortcodes' => true,
                                    'fw-storage' => array(
                                        'type' => 'post-meta',
                                        'post-meta' => 'global_content_meta',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            );
        }
        return $options;
    }
}
