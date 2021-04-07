<?php

namespace Inc\Base;

class BaseController
{
    public $plugin_path;

    public $plugin_url;

    public $plugin;

    public $managers = [];


    public function __construct()
    {
        $this->plugin_path =  plugin_dir_path(dirname(__FILE__, 2));

        $this->plugin_url =  plugin_dir_url(dirname(__FILE__, 2));

        $this->plugin =  plugin_basename(dirname(__FILE__, 3)) . '/learning.php';

        $this->managers = [
            "cpt" => "Activate CPT Manager",
            "taxonomy" => "Activate Taxonomy Manager",
            "media_widgets" => "Activate Media Widget",
            "gallery" => "Activate Gallery Manager",
            "testimonial" => "Activate Testimonial Manager",
            "templates" => "Activate Templates Manager",
            "login" => "Activate Ajax Login/Signup",
            "membership" => "Activate Membership Manager",
            "chat" => "Activate Chat Manager",
        ];
    }

    public function activated(string $key)
    {
        $option = get_option('data_learning_plugin');
        return isset($option[$key]) ? $option[$key] : false;
    }
}
