<?php
/**
 * @package  LearningPlugin
 */
namespace Inc;

class Deactivate
{

    public static function deactivate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}
