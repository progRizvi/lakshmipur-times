<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
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
        $videos = Video::paginate(15);

        return view('admin.pages.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'status' => 'required',
        ]);

        $video = Video::create([
            'link' => $request->link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.video.edit', $video->id)->with(['messege' => __('Created successfully'), 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::find($id);
        return view('admin.pages.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'link' => 'required',
            'status' => 'required',
        ]);

        $video = Video::find($id);
        $video->link = $request->link;
        $video->status = $request->status;
        $video->save();

        return redirect()->route('admin.video.index')->with(['messege' => __('Updated successfully'), 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::find($id);
        $video->delete();
        return redirect()->route('admin.video.index')->with(['messege' => __('Deleted successfully'), 'alert-type' => 'success']);
    }
}
