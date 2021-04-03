<?php

/**
 * @package  LearningPlugin
 */
/*
Plugin Name: Learning
Plugin URI: ajidk.nasihosting.com
Description: This is my first attempt on writing a custom Plugin for this amazing tutorial series.
Version: 1.0.0
Author: Ajidk
Author URI: ajidk.nasihosting.com
License: GPLv2 or later
Text Domain: learning
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/
defined('ABSPATH') or die('Hai, Anda tidak dapat mengakses file ini, dasar manusia konyol!');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Activate;
use Inc\Deactivate;
// use Inc\Admin\AdminPages;

if (!class_exists('Learning')) {
    class Learning
    {
        public $plugin;

        public function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
        }

        public function register()
        {
            add_action('admin_enqueue_scripts', [$this, 'enqueue']);
            add_action('admin_menu', [$this, 'add_admin_menu']);
            add_filter("plugin_action_links_$this->plugin", [$this, 'setting_link']);
        }

        public function setting_link($links)
        {
            $setting_link = '<a href="admin.php?page=plugin_learning">Settings</a>';
            array_push($links, $setting_link);
            return $links;
        }

        public function add_admin_menu()
        {
            add_menu_page('Learning Plugin', 'Learning', 'manage_options', 'plugin_learning', [$this, 'admin_index'], 'dashicons-store', 110);
        }

        public function admin_index()
        {
            require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
        }

        public function create_post_type()
        {
            add_action('init', [$this, 'custom_post_type']);
        }

        public function custom_post_type()
        {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        public function enqueue()
        {
            wp_enqueue_style('styles', plugins_url('/assets/css/styles.css', __FILE__));
            wp_enqueue_script('main', plugins_url('/assets/js/main.js', __FILE__));
        }

        public function activate()
        {
            Activate::activate();
        }

        public function deactivate()
        {
            Deactivate::deactivate();
        }
    }

    $learning = new Learning();
    $learning->register();
    // echo '<pre>' . print_r(Activate::activate(), 1) . '</pre>';
    // die;
    // $learning->create_post_type();

    // require_once plugin_dir_path(__FILE__) . 'inc/Activate.php';
    // require_once plugin_dir_path(__FILE__) . 'inc/Deactivate.php';

    register_activation_hook(__FILE__, [$learning, 'activate']);
    register_deactivation_hook(__FILE__, [$learning, 'deactivate']);
}
