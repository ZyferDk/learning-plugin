<?php

namespace Inc\Base\Controller;

use Inc\Api\CallBacks\AdminCallbacks;
use Inc\Base\BaseController;
use Inc\Api\SettingsApi;

class CustomPostTypeController extends BaseController
{
    // public $settings;

    public $callbacks;

    public $subpages = [];

    public $custom_post_types = [];

    public function register()
    {

        if (!$this->activated('cpt')) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->set_subpages();

        $this->settings->addSubPages($this->subpages)->register();

        $this->store_custom_post_types();

        if (!empty($this->custom_post_types)) {
            add_action('init', [$this, 'activate']);
        }
    }

    public function set_subpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'learning_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CTP',
                'capability' => 'manage_options',
                'menu_slug' => 'learning_cto',
                'callback' => [$this->callbacks, 'cto'],
            ]
        ];
    }

    public function store_custom_post_types()
    {
        $this->custom_post_types = [
            [
                'post_type' => 'learning_books',
                'name' => 'Books',
                'singular_name' => 'Book',
                'public' => true,
                'has_archive' => true,

            ],
            [
                'post_type' => 'learning_tools',
                'name' => 'Tools',
                'singular_name' => 'tool',
                'public' => true,
                'has_archive' => true,

            ]
        ];
    }

    public function activate()
    {
        foreach ($this->custom_post_types as $post_type) {
            register_post_type(
                $post_type['post_type'],
                [
                    'labels' => array(
                        'name' => $post_type['name'],
                        'singular_name' => $post_type['singular_name']
                    ),
                    'public' => $post_type['public'],
                    'has_archive' => $post_type['has_archive'],
                ]
            );
        }
    }
}
