<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'comment',
        'name',
        'news_id',
        'email',
        'status',
    ];

    public function post(): ?BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
