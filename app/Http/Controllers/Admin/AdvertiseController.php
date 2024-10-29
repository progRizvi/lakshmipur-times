<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topAdvertise = Advertise::where('position', 'top')->first();
        $singleAdvertise = Advertise::where('position', 'single')->first();
        $doubleAdvertise = Advertise::where('position', 'double')->get();
        return view('admin.pages.advertise.index', compact('singleAdvertise', 'doubleAdvertise', 'topAdvertise'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        if ($request->position == 'top') {
            $singleAdvertise = Advertise::where('position', 'top')->first();
            if (!$singleAdvertise) {
                $singleAdvertise = new Advertise();
            }
            $singleAdvertise->status = $request->status;
            $singleAdvertise->link = $request->link;
            $singleAdvertise->position = 'top';
            $singleAdvertise->title = $request->title;
            if ($request->hasFile('image')) {
                $image = file_upload($request->image, 'uploads/custom-images/', $singleAdvertise?->image);
                $singleAdvertise->image = $image;
            }
            $singleAdvertise->save();
        } else if ($request->position == 'single') {
            $singleAdvertise = Advertise::where('position', 'single')->first();
            if (!$singleAdvertise) {
                $singleAdvertise = new Advertise();
            }
            $singleAdvertise->status = $request->status;
            $singleAdvertise->link = $request->link;
            $singleAdvertise->position = 'single';
            $singleAdvertise->title = $request->title;
            if ($request->hasFile('image')) {
                $image = file_upload($request->image, 'uploads/custom-images/', $singleAdvertise?->image);
                $singleAdvertise->image = $image;
            }
            $singleAdvertise->save();
        } else if ('double') {
            foreach ($request->title as $key => $status) {
                $doubleAdvertise = Advertise::where('position', 'double')->where('id', $key)->first();
                if (!$doubleAdvertise) {
                    $doubleAdvertise = new Advertise();
                }
                $doubleAdvertise->status = isset($request->status[$key]) ? 1 : 0;
                $doubleAdvertise->link = $request->link[$key];
                $doubleAdvertise->position = 'double';
                $doubleAdvertise->title = $request->title[$key];
                if ($request->hasFile('image')) {
                    $image = file_upload($request->image[$key], 'uploads/custom-images/', $doubleAdvertise?->image);
                    $doubleAdvertise->image = $image;
                }
                $doubleAdvertise->save();
            }
        }

        $notification = ['messege' => __('Update Successfully'), 'alert-type' => 'success'];
        return back()->with($notification);
    }
}
