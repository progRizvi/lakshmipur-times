<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Blog\app\Models\News;
use Modules\Language\app\Models\Language;
use Modules\OurTeam\app\Models\OurTeam;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function dashboard(Request $request)
    {
        // remove intended url from session
        $request->session()->forget('url');

        $data['recentNews'] = News::latest()->take(5)->get();
        $data['totalNews'] = News::count();
        $data['teamMembers'] = OurTeam::count();


        return view('admin.dashboard', compact('data'));
    }

    public function setLanguage()
    {
        $action = setLanguage(request('code'));

        if ($action) {
            $notification = __('Language Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        }

        $notification = __('Language Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
    public function setCurrency()
    {
        $currency = allCurrencies()->where('currency_code', request('currency'))->first();

        if (session()->has('currency_code')) {
            session()->forget('currency_code');
            session()->forget('currency_position');
            session()->forget('currency_icon');
            session()->forget('currency_rate');
        }
        if ($currency) {
            session()->put('currency_code', $currency->currency_code);
            session()->put('currency_position', $currency->currency_position);
            session()->put('currency_icon', $currency->currency_icon);
            session()->put('currency_rate', $currency->currency_rate);

            $notification = __('Currency Changed Successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->back()->with($notification);
        }
        getSessionCurrency();
        $notification = __('Currency Changed Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}
