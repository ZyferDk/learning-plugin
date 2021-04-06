<?php

/**
 * @package  LearningPlugin
 */

namespace Inc;

use Inc\Base\Controller\CustomPostTypeController;
use Inc\Base\Controller\CustomTaxonomyController;

class Init
{
    public static function get_services()
    {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingLinks::class,
            CustomPostTypeController::class,
            CustomTaxonomyController::class,
        ];
    }

    public static function register_services()
    {
        foreach (self::get_services() as $key => $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
