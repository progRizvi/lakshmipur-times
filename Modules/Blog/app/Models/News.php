<?php

namespace Modules\Blog\app\Models;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{

    protected $table = 'news';
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'state_id',
        'city_id',
        'title',
        'short_description',
        'description',
        'slug',
        'image',
        'reporter',
        'views',
        'show_homepage',
        'is_popular',
        'news_ticker',
        'date',
        'latest',
        'tags',
        'status',
        'seo_title',
        'seo_description',
    ];


    public function comments(): ?HasMany
    {
        return $this->hasMany(NewsComment::class, 'news_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'news_categories');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
