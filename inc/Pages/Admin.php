<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\CallBacks\AdminCallbacks;

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = [];

	public $subpages = [];

	public function register()
	{

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

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
				'option_name' => 'username',
				'callback' => [$this->callbacks, 'learningOptionGroup']
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'first_name',
			],
			[
				'option_group' => 'learning_options_group',
				'option_name' => 'tempat_lahir',
			]
		];

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'learning_admin_index',
				'title' => 'Settings',
				'callback' => [$this->callbacks, 'learningAdminSection'],
				'page' => 'learning_plugin',
			]
		];
		$this->settings->setSections($args);
	}

	public function setFields()
	{

		$args = array(
			array(
				'id' => 'username',
				'title' => 'Username',
				'callback' => array($this->callbacks, 'learningTextExample'),
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => array(
					'label_for' => 'username',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => array($this->callbacks, 'learningFirstName'),
				'page' => 'learning_plugin',
				'section' => 'learning_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => 'example-class'
				)
				),
				[
					'id' => 'tempat_lahir',
					'title' => 'tempat lahir',
					'callback' => [$this->callbacks, 'learning_tempat_lahir'],
					'page' => 'learning_plugin',
					'section' => 'learning_admin_index',
					'args' => [
						'label_for' => 'tempat_lahir',
						'class' => 'example_class',
					],

				]
		);

		$this->settings->setFields($args);
	}
}
