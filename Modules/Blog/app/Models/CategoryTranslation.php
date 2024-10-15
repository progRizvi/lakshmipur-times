<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\factories\CategoryTranslationFactory;

class CategoryTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): CategoryTranslationFactory
    {
        //return CategoryTranslationFactory::new();
    }
}
