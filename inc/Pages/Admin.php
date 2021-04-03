<?php

namespace Inc\Pages;

class Admin
{
	public function register()
	{
		add_action('admin_menu', [$this, 'add_admin_menu']);
	}

	public function add_admin_menu()
	{
		add_menu_page('Learning Plugin', 'Learning', 'manage_options', 'plugin_learning', [$this, 'admin_index'], 'dashicons-store', 110);
	}

	public function admin_index()
	{
		require_once PLUGIN_PATH . 'templates/admin.php';
	}
}
