<?php

/**
 * @package  Leaning
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
defined('ABSPATH') or die('Hey, you can\t access this file, you silly human!');

class Learning
{
    public function __construct()
    {
        // add_action('init', [$this, 'custom_post_type']);
    }

    public function register()
    {
        $this->create_post_type();
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    private function create_post_type()
    {
        add_action('init', [$this, 'custom_post_type']);
    }

    public function activate()
    {
        // generated a CPT
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }

    public function uninstall()
    {
        // delete CPT
        // delete all the plugin data from the DB
    }

    public function custom_post_type()
    {
        register_post_type('book', ['public' => true, 'label' => 'Absensi']);
    }

    public function enqueue()
    {
        wp_enqueue_style('styles', plugins_url('/assets/css/styles.css', __FILE__));
        wp_enqueue_script('main', plugins_url('/assets/js/main.js', __FILE__));
    }

    public function ajidk()
    {
        echo 'aman hari ini';
    }
}

if (class_exists('Learning')) {
    $learning = new Learning();
    // $learning->register();
}

// activation
register_activation_hook(__FILE__, [$learning, 'activate']);
register_activation_hook(__FILE__, [$learning, 'deactivate']);

class DuoClass extends Learning
{
    public function mantap()
    {
        $this->register();
    }
}

$duo = new DuoClass();
$duo->mantap();
