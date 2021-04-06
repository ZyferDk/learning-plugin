<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\CallBacks\AdminCallbacks;
use Inc\Api\CallBacks\ManagerCallbacks;

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $manager_callbacks;

	public $pages = [];

	public $subpages = [];

	public function register()
	{

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->manager_callbacks = new ManagerCallbacks;

		$this->set_pages();

		$this->set_subpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
	}

	// set pages
	public function set_pages()
	{

		$this->pages = [
			[
				"page_title" => 'Learning Plugin',
				"menu_title" => 'Learning',
				"capability" => 'manage_options',
				"menu_slug" => 'learning_plugin',
				"callback" => [$this->callbacks, 'Dashboard'],
				"icon_url" => 'dashicons-store',
				"position" => 110,
			]
		];
	}
	// end set pages

	// set subpages
	public function set_subpages()
	{
		$this->subpages = [
			[
				'parent_slug' => 'learning_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CTO',
				'capability' => 'manage_options',
				'menu_slug' => 'learning_cto',
				'callback' => [$this->callbacks, 'cto'],
			],
			[
				'parent_slug' => 'learning_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'learning_taxonomies',
				'callback' => [$this->callbacks, 'taxonomy'],
			],			[
				'parent_slug' => 'learning_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'learning_widgets',
				'callback' => [$this->callbacks, 'widget'],
			],
		];
	}
	// end set subpages



	public function setSettings()
	{
		$args = [
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'data_learning_plugin',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			]
		];

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'learning_admin_index',
				'title' => 'Settings Manager',
				'callback' => [$this->manager_callbacks, 'managerCallbacksOptionSection'],
				'page' => 'data_learning_plugin',
			]
		];
		$this->settings->setSections($args);
	}

	public function setFields()
	{

		$args = [];

		foreach ($this->managers as $key => $value) :
			$args[] = [
				'id' => $key,
				'title' => $value,
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'data_learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'option_name' => 'data_learning_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle',
				],

			];
		endforeach;

		$this->settings->setFields($args);
	}
}
