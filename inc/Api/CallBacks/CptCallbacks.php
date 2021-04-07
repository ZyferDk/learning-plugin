<?php

namespace Inc\Api\CallBacks;

class CptCallbacks
{

    public function cptSectionsManager()
    {
        echo "Create as Many Custom Types as you want.";
    }

    public function ctpSanitize($input)
    {
        $learning_cpt = ['post_type', 'plural_name', 'singular_name', 'public', 'has_archive'];

        $output = [];

        foreach ($learning_cpt as $value) {
            $output[$value] = isset($input[$value]) ? $input[$value] : false;
            // $output[$value] = $input[$value];
        }

        return $output;
    }

    public function textField($args)
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $input = get_option($option_name);
        $value = '';
        $value = $input[$name];

        echo '
            <input type="text" id="' . $name . '" class="regular-text" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args["placeholder"] . '">
        ';
    }

    public function checkboxField($args)
    {
        echo '<pre>'.print_r($args,1).'</pre>';
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option($option_name);
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
        echo '
            <div class="' . $classes . '">
                <input type="checkbox" id="' . $name . '"  name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checked ? 'checked' : '') . '>
                <label for="' . $name . '">
                    <div>
                    </div>
                </label>
            </div>
        ';
    }
}
