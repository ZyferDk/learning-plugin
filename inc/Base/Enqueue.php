<?php

/**
 * @package  LearningPlugin
 */

namespace Inc\Base;

class Enqueue
{

    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('styles', plugins_url('/assets/css/styles.css', __FILE__));
        wp_enqueue_script('main', plugins_url('/assets/js/main.js', __FILE__));
    }
}
