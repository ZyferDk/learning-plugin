<?php

/**
 * @package  LearningPlugin
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();


        if (get_option('data_learning_plugin')) {
            return;
        }

        $default = [];
        update_option('data_learning_plugin', $default);
        update_option('learning_plugin_cpt', $default);
    }
}
