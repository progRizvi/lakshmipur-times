<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Video;
use App\Rules\CustomRecaptcha;
use Illuminate\Http\Request;
use Modules\Blog\app\Models\Category;
use Modules\Blog\app\Models\News;
use Modules\Blog\app\Models\NewsComment;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\OurTeam\app\Models\OurTeam;
use Modules\PageBuilder\app\Models\CustomizeablePage;

class WebsiteController extends Controller
{
    public function home()
    {
        $mostLatestNews = News::where('status', 1)->where('latest', 1)->orderBy('id', 'desc')->first();
        $secondMost = News::where('status', 1)->where('latest', 1)->orderBy('id', 'desc')->skip(1)->limit(2)->get();
        $newses = News::where('status', 1)->where('show_homepage', 1)->orderBy('id', 'desc')->skip(3)->limit(6)->get();
        $videos = Video::where('status', 1)->get();

        $singleAdvertise = Advertise::where('position', 'single')->where('status', 1)->first();
        $doubleAdvertise = Advertise::where('position', 'double')->where('status', 1)->get();
        return view('website.index', compact('mostLatestNews', 'secondMost', 'newses', 'videos', 'singleAdvertise', 'doubleAdvertise'));
    }

    public function search()
    {
        $news = News::query();
        $news = $news->where('status', 1);

        if (request()->search) {
            $news = $news->where('title', 'like', '%' . request()->search . '%');
        }

        if (request()->district) {
            $news = $news->whereHas('state', function ($q) {
                $q->where('name', 'like', '%' . strtolower(request()->district) . '%');
            });
        }

        if (request()->thana) {
            $news = $news->whereHas('city', function ($q) {
                $q->where('name', 'like', '%' . strtolower(request()->thana) . '%');
            });
        }
        $title = 'অনুসন্ধান ফলাফল';
        $news->with('city');
        $news = $news->paginate(1);
        $news->appends(request()->all());

        if (request()->ajax()) {
            return view('components.news-pagination', compact('news'))->render();
        }

        return view('website.search', compact('title', 'news'));
    }

    public function newsDetails($slug)
    {
        $news = News::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('website.news-details', compact('news'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->firstOrFail();
        $news = $category->news()->with('city')->paginate(1);
        $title = $category->title;

        if (request()->ajax()) {
            return view('components.news-pagination', compact('news'))->render();
        }
        return view('website.search', compact('category', 'news', 'title'));
    }

    public function commentPost(Request $request)
    {
        $setting = Setting::where("key", "recaptcha_secret_key")->first();

        $rules = [
            'name' => 'required',
            'email' => 'nullable|email',
            'comment' => 'required',
            'news_id' => 'required',
            'g-recaptcha-response' => $setting->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : '',
        ];
        $customMessages = [
            'name.required' => __('Name is required'),
            'email.email' => __('Email is not valid'),
            'comment.required' => __('Comment is required'),
            'g-recaptcha-response.required' => __('Verify You are not robot'),
        ];

        $this->validate($request, $rules, $customMessages);

        $comment = new NewsComment();
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id ?: 0;
        $comment->name = $request->name;
        $comment->status = 0;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();
        $notification = __('News comment submitted successfully');
        return response()->json(['status' => 1, 'message' => $notification], 200);
    }

    public function pages($slug)
    {
        $page = CustomizeablePage::whereSlug($slug)->firstOrFail();
        return view('website.custom-pages', [
            'content' => $page?->description,
            'title' => $page?->title
        ]);
    }

    public function team()
    {
        $teams = OurTeam::where('status', 'active')->get();
        return view('website.team', compact('teams'));
    }

    public function contact()
    {
        return view('website.contact');
    }
}
