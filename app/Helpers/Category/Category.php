<?php

namespace App\Helpers\Category;

use App\Helpers\Container;

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

    public static function getIds(int $categoryId): string
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

    public static function getBreadcrumbs(int $categoryId)
    {
        $categories = self::getCategories();

        $breadcrumbs = [];
        foreach ($categories as $item) {
            if (isset($categories[$categoryId])) {
                $breadcrumbs[$categories[$categoryId]['slug']] = $categories[$categoryId]['title'];
                $categoryId = $categories[$categoryId]['parent_id'];
            } else {
                break;
            }
        }

        return array_reverse($breadcrumbs);

    }
}
