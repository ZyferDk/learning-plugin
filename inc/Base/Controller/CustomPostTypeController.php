<?php

namespace Inc\Base\Controller;

use Inc\Api\CallBacks\AdminCallbacks;
use Inc\Api\CallBacks\CptCallbacks;
use Inc\Base\BaseController;
use Inc\Api\SettingsApi;

class CustomPostTypeController extends BaseController
{
    public $settings;

    public $callbacks;

    public $cpt_callbacks;

    public $subpages = [];

    public $custom_post_types = [];

    public function register()
    {

        if (!$this->activated('cpt')) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->cpt_callbacks = new CptCallbacks;

        $this->set_subpages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addSubPages($this->subpages)->register();

        $this->storeCustomPostTypes();

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
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'learning_cpt',
                'callback' => [$this->callbacks, 'ctp'],
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'learning_plugin_cpt_settings',
                'option_name' => 'learning_plugin_cpt',
                'callback' => [$this->cpt_callbacks, 'ctpSanitize']
            ]
        ];

        return $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'learning_cpt_index',
                'title' => 'Custom Post Type Manager',
                'callback' => [$this->cpt_callbacks, 'cptSectionsManager'],
                'page' => 'learning_cpt',
            ]
        ];

        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = [];

        $args = [
            [
                'id' => 'post_type',
                'title' => 'Custom Post Type ID',
                'callback' => [$this->cpt_callbacks, 'textField'],
                'page' => 'learning_cpt',
                'section' => 'learning_cpt_index',
                'args' => [
                    'option_name' => 'learning_plugin_cpt',
                    'label_for' => 'post_type',
                    'placeholder' => 'eg. Product',

                ],
            ],
            [
                'id' => 'plural_name',
                'title' => 'Plural Name',
                'callback' => [$this->cpt_callbacks, 'textField'],
                'page' => 'learning_cpt',
                'section' => 'learning_cpt_index',
                'args' => [
                    'option_name' => 'learning_plugin_cpt',
                    'label_for' => 'plural_name',
                    'placeholder' => 'eg. Product',
                ],
            ],
            [
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => [$this->cpt_callbacks, 'textField'],
                'page' => 'learning_cpt',
                'section' => 'learning_cpt_index',
                'args' => [
                    'option_name' => 'learning_plugin_cpt',
                    'label_for' => 'singular_name',
                    'placeholder' => 'eg. Products',
                ]
            ],
            [
                'id' => 'public',
                'title' => 'Public',
                'callback' => [$this->cpt_callbacks, 'checkboxField'],
                'page' => 'learning_cpt',
                'section' => 'learning_cpt_index',
                'args' => [
                    'option_name' => 'learning_plugin_cpt',
                    'label_for' => 'public',
                    'class' => 'ui-toggle',
                ]
            ],
            [
                'id' => 'has_archive',
                'title' => 'Archive',
                'callback' => [$this->cpt_callbacks, 'checkboxField'],
                'page' => 'learning_cpt',
                'section' => 'learning_cpt_index',
                'args' => [
                    'option_name' => 'learning_plugin_cpt',
                    'label_for' => 'has_archive',
                    'class' => 'ui-toggle',
                ]
            ]
        ];

        $this->settings->setFields($args);
    }

    public function storeCustomPostTypes()
    {

        $options = get_option('learning_plugin_cpt');

        $post_type = $options['post_type'];
        $plural_name = $options['plural_name'];
        $singular_name = $options['singular_name'];
        $public = $options['public'];
        $has_archive = $options['has_archive'];

        $this->custom_post_types[] = [
            'post_type'             => $post_type,
            'name'                  => $plural_name,
            'singular_name'         => $singular_name,
            'menu_name'             => $plural_name,
            'name_admin_bar'        => $singular_name,
            'archives'              => $singular_name,
            'attributes'            => $singular_name,
            'parent_item_colon'     => "Parent $singular_name",
            'all_items'             => "All $plural_name",
            'add_new_item'          => "Add new $singular_name",
            'add_new'               => "Add New",
            'new_item'              => "New $singular_name",
            'edit_item'             => "Edit $singular_name",
            'update_item'           => "Update $singular_name",
            'view_item'             => "View $singular_name",
            'view_items'            => "View $plural_name",
            'search_items'          => "Search $plural_name",
            'not_found'             => "Not $singular_name found",
            'not_found_in_trash'    => "Not $singular_name found in Trash",
            'featured_image'        => "Featured Image",
            'set_featured_image'    => "Set featured image",
            'remove_featured_image' => "Remove featured image",
            'use_featured_image'    => "Use as featured image",
            'insert_into_item'      => "Insert into $singular_name",
            'uploaded_to_this_item' => "Uploaded to this $singular_name",
            'items_list'            => "$plural_name list",
            'items_list_navigation' => "$plural_name list navigation",
            'filter_items_list'     => "Filter $plural_name list",
            'label'                 => "$singular_name",
            'description'           => "$plural_name Custom Post Type",
            'label'                 => $singular_name,
            'supports'              => ['title', 'editor', 'thumbnail'],
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => $public,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => $has_archive,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        ];
    }

    public function activate()
    {
        foreach ($this->custom_post_types as $post_type) {
            // echo '<pre>'.print_r($post_type,1).'</pre>';die;
            register_post_type(
                $post_type['post_type'],
                [
                    'labels' => [
                        'name'                  => $post_type['name'],
                        'singular_name'         => $post_type['singular_name'],
                        'menu_name'             => $post_type['menu_name'],
                        'name_admin_bar'        => $post_type['name_admin_bar'],
                        'archives'              => $post_type['archives'],
                        'attributes'            => $post_type['attributes'],
                        'parent_item_colon'     => $post_type['parent_item_colon'],
                        'all_items'             => $post_type['all_items'],
                        'add_new_item'          => $post_type['add_new_item'],
                        'add_new'               => $post_type['add_new'],
                        'new_item'              => $post_type['new_item'],
                        'edit_item'             => $post_type['edit_item'],
                        'update_item'           => $post_type['update_item'],
                        'view_item'             => $post_type['view_item'],
                        'view_items'            => $post_type['view_items'],
                        'search_items'          => $post_type['search_items'],
                        'not_found'             => $post_type['not_found'],
                        'not_found_in_trash'    => $post_type['not_found_in_trash'],
                        'featured_image'        => $post_type['featured_image'],
                        'set_featured_image'    => $post_type['set_featured_image'],
                        'remove_featured_image' => $post_type['remove_featured_image'],
                        'use_featured_image'    => $post_type['use_featured_image'],
                        'insert_into_item'      => $post_type['insert_into_item'],
                        'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
                        'items_list'            => $post_type['items_list'],
                        'items_list_navigation' => $post_type['items_list_navigation'],
                        'filter_items_list'     => $post_type['filter_items_list'],
                    ],
                    'label'                 => $post_type['label'],
                    'description'           => $post_type['description'],
                    'supports'              => $post_type['supports'],
                    'taxonomies'            => $post_type['taxonomies'],
                    'hierarchical'          => $post_type['hierarchical'],
                    'public'                => $post_type['public'],
                    'show_ui'               => $post_type['show_ui'],
                    'show_in_menu'          => $post_type['show_in_menu'],
                    'menu_position'         => $post_type['menu_position'],
                    'show_in_admin_bar'     => $post_type['show_in_admin_bar'],
                    'show_in_nav_menus'     => $post_type['show_in_nav_menus'],
                    'can_export'            => $post_type['can_export'],
                    'has_archive'           => $post_type['has_archive'],
                    'exclude_from_search'   => $post_type['exclude_from_search'],
                    'publicly_queryable'    => $post_type['publicly_queryable'],
                    'capability_type'       => $post_type['capability_type'],
                ]
            );
        }
    }
}
