<?php

namespace Modules\Language\app\Enums;

enum TranslationModels: string
{
    /**
     * whenever update new case also update getAll() method
     * to return all values in array
     */
    case Blog = "Modules\Blog\app\Models\NewsTranslation";
    case NewsCategory = "Modules\Blog\app\Models\NewsCategoryTranslation";
    case Menu = "Modules\CustomMenu\app\Models\MenuTranslation";
    case MenuItem = "Modules\CustomMenu\app\Models\MenuItemTranslation";

    public static function getAll(): array
    {
        return [
            self::Blog->value,
            self::NewsCategory->value,
            self::Menu->value,
            self::MenuItem->value,
        ];
    }

    public static function igonreColumns(): array
    {
        return [
            'id',
            'lang_code',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }
}
