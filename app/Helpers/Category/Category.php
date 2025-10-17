<?php

namespace App\Helpers\Category;

class Category
{
    public static string $tpl;

    public static function getMenu(string $tpl, string $cacheKey = '')
    {
        self::$tpl = $tpl;
        if ($cacheKey) {
            $menu_html = cache($cacheKey, '');
            if ($menu_html) {
                return $menu_html;
            }
        }
    }

    public static function getCategories()
    {

    }
}
