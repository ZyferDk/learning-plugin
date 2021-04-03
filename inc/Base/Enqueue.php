<?php

/**
 * @package  LearningPlugin
 */

namespace Inc\Base;

class Enqueue extends BaseController
{

    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('styles', $this->plugin_url . '/assets/css/styles.css', __FILE__);
        wp_enqueue_script('main', $this->plugin_url . '/assets/js/main.js', __FILE__);
    }
}
