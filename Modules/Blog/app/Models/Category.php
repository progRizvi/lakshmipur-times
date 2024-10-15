<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blog\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'short_description',
        'slug',
        'position',
        'parent_id',
        'status',
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_categories');
    }
}
