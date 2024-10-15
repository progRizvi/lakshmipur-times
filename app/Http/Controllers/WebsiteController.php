<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\app\Models\News;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.index');
    }

    public function search()
    {
        return view('website.search');
    }

    public function newsDetails($slug)
    {
        $news = News::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('website.news-details', compact('news'));
    }
}
