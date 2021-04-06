<?php

namespace Inc\Base\Controller;

use Inc\Api\CallBacks\AdminCallbacks;
use Inc\Base\BaseController;
use Inc\Api\SettingsApi;

class CustomTaxonomyController extends BaseController
{
    // public $settings;

    public $callbacks;

    public $subpages = [];

    public $custom_post_types = [];

    public function register()
    {
        if (!$this->activated('taxonomy')) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->set_subpages();

        $this->settings->addSubPages($this->subpages)->register();

    }

    public function set_subpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'learning_plugin',
                'page_title' => 'Custom Taxonomy',
                'menu_title' => 'Taxonomy',
                'capability' => 'manage_options',
                'menu_slug' => 'learning_taxonomy',
                'callback' => [$this->callbacks, 'taxonomy'],
            ]
        ];
    }
}
