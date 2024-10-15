<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = ['news_id', 'category_id'];

    public function news(): HasOne
    {
        return $this->hasOne(News::class, 'id', 'news_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
