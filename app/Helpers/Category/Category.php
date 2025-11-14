<?php

namespace App\Helpers\Category;

use App\Helpers\Container;
use staabm\SideEffectsDetector\SideEffect;

class Category
{
    public static string $tpl;

    public static function getMenu(string $tpl, string $cacheKey = '')
    {
        self::$tpl = $tpl;
        if ($cacheKey) {
            $menuHtml = cache($cacheKey, '');
            if ($menuHtml) {
                return $menuHtml;
            }
        }

        $categoriesData = self::getCategories();
        $categoriesTree = self::getTree($categoriesData);
        $menuHtml       = self::getHtml($categoriesTree);

        if ($cacheKey) {
            cache([$cacheKey => $menuHtml], now()->addDay());
        }

        return $menuHtml;
    }

    public static function getCategories()
    {
        $categoriesData = Container::get('categories_data');
        if (!$categoriesData) {
            $categoriesData = \App\Models\Category::all()->keyBy('id')->toArray();
            Container::set('categories_data', $categoriesData);
        }

        return $categoriesData;
    }

    public static function getTree($data)
    {
        $categoriesTree = [];
        foreach ($data as $id => &$value) {
            if (!$value['parent_id']) {
                $categoriesTree[$id] = &$value;
            } else {
                $data[$value['parent_id']]['children'][$id] = &$value;
            }
        }

        return $categoriesTree;
    }

    public static function getHtml(array $tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $item) {
            $str .= self::item2Tpl($item, $tab, $id);
        }

        return $str;
    }

    public static function item2Tpl($item, $tab, $id)
    {
        ob_start();
        echo view(self::$tpl, ['item' => $item, 'tab' => $tab, 'id' => $id]);

        return ob_get_clean();
    }

    public static function getIds(int $categoryId)
    {
        $categories = self::getCategories();
        $ids = '';
        foreach ($categories as $category) {
            if ($category['parent_id'] == $categoryId){
                $ids .= $category['id'] . ',';
                $ids .= self::getIds($category['id']);
            }
        }

        return $ids;
    }
}
