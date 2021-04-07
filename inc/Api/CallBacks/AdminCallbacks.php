<?php

namespace Inc\Api\CallBacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    // move folder to admin.php
    public function Dashboard()
    {
        return require_once("$this->plugin_path/templates/admin.php");
    }

    // move folder to cto.php
    public function ctp()
    {
        return require_once("$this->plugin_path/templates/ctp.php");
    }

    // move folder to taxonomy.php
    public function taxonomy()
    {
        return require_once("$this->plugin_path/templates/taxonomy.php");
    }

    // move folder to widget.php
    public function widget()
    {
        return require_once("$this->plugin_path/templates/widget.php");
    }

    public function learningOptionGroup($input)
    {
        return $input;
    }

    public function learningAdminSection()
    {
        echo 'Periksa bagian cantik ini!';
    }

    public function learningTextExample()
    {
        $value = esc_attr(get_option('username'));
        echo '<input type="text" class="regular-text" name="username" value="' . $value . '" placeholder="Write Something Here!">';
    }

    public function learningFirstName()
    {
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
    }

    public function learning_tempat_lahir()
    {
        $value = esc_attr(get_option('tempat_lahir'));
        echo '<textarea name="tempat_lahir" class="regular-text">' . $value . '</textarea>';
    }
}
