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
				'option_name' => 'cpt',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'taxonomy',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'media_widgets',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'gallery',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'testimonial',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'templates',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'login',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'membership',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'chat',
				'callback' => [$this->manager_callbacks, 'checkboxSanitize']
			],


		];

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'learning_admin_index',
				'title' => 'Settings',
				'callback' => [$this->manager_callbacks, 'managerCallbacksOptionSection'],
				// 'callback' => [$this->callbacks, 'learningAdminSection'],
				'page' => 'learning_plugin',
			]
		];
		$this->settings->setSections($args);
	}

	public function setFields()
	{

		$args = [
			[
				'id' => 'cpt',
				'title' => 'Activate CPT Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'cpt',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'taxonomy',
				'title' => 'Activate Taxonomy Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'taxonomy',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'media_widgets',
				'title' => 'Activate Media Widget',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'media_widgets',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'gallery',
				'title' => 'Activate Gallery Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'gallery',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'testimonial',
				'title' => 'Activate Testimonial Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'testimonial',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'templates',
				'title' => 'Activate Templates Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'templates',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'login',
				'title' => 'Activate Ajax Login/Signup',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'login',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'membership',
				'title' => 'Activate Membership Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'membership',
					'class' => 'ui-toggle',
				],

			],
			[
				'id' => 'chat',
				'title' => 'Activate Chat Manager',
				'callback' => [$this->manager_callbacks, 'checkboxField'],
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => [
					'label_for' => 'chat',
					'class' => 'ui-toggle',
				],

			]
		];

		$this->settings->setFields($args);
	}
}
