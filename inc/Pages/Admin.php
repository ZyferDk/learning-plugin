<?php

namespace Inc\Pages;

use Inc\Base\BaseController;
use Inc\Api\SettingsApi;

class Admin extends BaseController
{
	public $settings;
	public $pages = [];
	public $subpages = [];

	public function __construct()
	{
		$this->settings = new SettingsApi();

		$this->pages = [
			[
				"page_title" => 'Learning Plugin',
				"menu_title" => 'Learning',
				"capability" => 'manage_options',
				"menu_slug" => 'plugin_learning',
				"callback" => function () {
					echo '<h1>Learning</h1>';
				},
				"icon_url" => 'dashicons-store',
				"position" => 110,
			]
		];

		$this->subpages = [
			[
				'parent_slug' => 'plugin_learning',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CTO',
				'capability' => 'manage_options',
				'menu_slug' => 'learning_cto',
				'callback' => function () {
					echo '<h1>CTO</h1>';
				},
			],
			[
				'parent_slug' => 'plugin_learning',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'learning_taxonomies',
				'callback' => function () {
					echo '<h1>Taxonomis</h1>';
				},
			],
		];
	}

	public function register()
	{
		$this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
	}
}
