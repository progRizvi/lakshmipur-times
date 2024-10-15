<?php

namespace Modules\OurTeam\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\OurTeam\app\Models\OurTeam;

class OurTeamController extends Controller {
    public function index() {
        checkAdminHasPermissionAndThrowException('team.management');
        $teams = OurTeam::all();

        return view('ourteam::index', compact('teams'));
    }

    public function create() {
        checkAdminHasPermissionAndThrowException('team.management');
        return view('ourteam::create');
    }

    public function store(Request $request) {
        checkAdminHasPermissionAndThrowException('team.management');
        $rules = [
            'name'        => 'required',
            'designation' => 'required',
            'image'       => 'required',
            'status'      => 'required',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'designation.required' => __('Designation is required'),
            'image.required'       => __('Image is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $team = new OurTeam();

        $file_name = '';
        if ($request->file('image')) {
            $file_name = file_upload($request->image);
        }

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->image = $file_name;
        $team->status = $request->status;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->linkedin = $request->linkedin;
        $team->instagram = $request->instagram;
        $team->save();

        $notification = __('Created Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.ourteam.index')->with($notification);
    }

    public function edit($id) {
        checkAdminHasPermissionAndThrowException('team.management');
        $team = OurTeam::find($id);

        return view('ourteam::edit', compact('team'));
    }

    public function update(Request $request, $id) {
        checkAdminHasPermissionAndThrowException('team.management');
        $rules = [
            'name'        => 'required',
            'designation' => 'required',
            'status'      => 'required',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'designation.required' => __('Designation is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $team = OurTeam::find($id);
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->status = $request->status;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->linkedin = $request->linkedin;
        $team->instagram = $request->instagram;
        $team->save();

        if ($request->file('image')) {
            $file_name = file_upload($request->image, 'uploads/custom-images/', $team->image);
            $team->image = $file_name;
            $team->save();
        }

        $notification = __('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.ourteam.index')->with($notification);
    }

    public function destroy($id) {
        checkAdminHasPermissionAndThrowException('team.management');
        $team = OurTeam::find($id);
        $existing_image = $team->image;
        $team->delete();

        if ($existing_image) {
            if (File::exists(public_path($existing_image))) {
                unlink(public_path($existing_image));
            }
        }

        $notification = __('Delete Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.ourteam.index')->with($notification);
    }
}
