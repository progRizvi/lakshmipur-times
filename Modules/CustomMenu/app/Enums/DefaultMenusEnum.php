<?php

namespace Modules\CustomMenu\app\Enums;

use Illuminate\Support\Collection;
use Modules\Blog\app\Models\Category;
use Modules\PageBuilder\app\Models\CustomizeablePage;

enum DefaultMenusEnum: string
{
    public static function getAll(): Collection
    {

        $all_default_menus = [
            (object) ['name' => __('প্রথম পাতা'), 'url' => '/'],
            (object) ['name' => __('আমরা'), 'url' => '/team'],
            (object) ['name' => __('যোগাযোগ'), 'url' => '/contact-us'],
            (object) ['name' => __('উপজেলা'), 'url' => '/upazila'],
        ];

        // categories
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $category) {
            $all_default_menus[] = (object) ['name' => $category->title, 'url' => '/category/' . $category->slug];
        }

        $pages = CustomizeablePage::where('status', 1)->get();

        foreach ($pages as $page) {
            $item = (object) ['name' => $page->title, 'url' => "/pages/$page->slug"];

            array_push($all_default_menus, $item);
        }

        // Sort the array by the 'name' property
        usort($all_default_menus, function ($a, $b) {
            return strcmp($a->name, $b->name);
        });

        // Convert the sorted array to a collection
        return collect($all_default_menus);
    }
}
