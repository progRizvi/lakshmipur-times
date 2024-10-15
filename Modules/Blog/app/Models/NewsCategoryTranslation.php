<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsCategoryTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'news_id',
        'lang_code',
        'title',
        'short_description',
    ];

    public function category(): ?BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
