<?php

namespace Modules\Blog\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'comment',
        'parent_id',
        'name',
        'news_id',
        'email',
        'status',
    ];

    public function post(): ?BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(NewsComment::class, 'parent_id')->where('status', 1);
    }

    public function children()
    {
        return $this->hasMany(NewsComment::class, 'parent_id')->where('status', 1);
    }
}
