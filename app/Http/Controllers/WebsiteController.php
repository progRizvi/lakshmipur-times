<?php

namespace App\Http\Controllers;

use App\Rules\CustomRecaptcha;
use Illuminate\Http\Request;
use Modules\Blog\app\Models\News;
use Modules\Blog\app\Models\NewsComment;
use Modules\GlobalSetting\app\Models\Setting;

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
}
