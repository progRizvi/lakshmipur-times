<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'news_id',
        'lang_code',
        'title',
        'description',
        'seo_title',
        'seo_description',
    ];

    public function post(): ?BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
