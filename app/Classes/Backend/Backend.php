<?php

namespace App\Classes\Backend;

    use App\Classes\Backend\MenuItem\MenuItem;
    use URL;

    class Backend
    {
        private static $menuItems = [];

        public static function loadMenuItems()
        {
            self::$menuItems = [];

            self::addMenuItem(
                new MenuItem([
                    'position' => -1,
                    'parent' => null,
                    'name' => 'dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'text' => __('backend/dashboard.title'),
                    'redirect' => URL::route('backend-dashboard'),
                    'route_name' => 'backend-dashboard',
                ])
            );
        }

        public static function addMenuItem(MenuItem $menuItem)
        {
            self::$menuItems[] = $menuItem;
        }

        public static function getMenuItems()
        {
            return self::$menuItems ?? [];
        }

        public static function setMenuItems(array $menuItems)
        {
            self::$menuItems = $menuItems;
        }
    }
