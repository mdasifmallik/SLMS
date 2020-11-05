<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Department;
use App\Application;

class LeaveManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        foreach ($user->departments as $department) {
            $dep = $department;
        }

        $title = "SLMS | All Leaves";

        return view('admin_pages.leave_management.all_leaves',compact('title','dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user= Auth::user();
        foreach ($user->departments as $department) {
            $dep = $department;
        }

        $title = "SLMS | Leave History";

        return view('admin_pages.leave_management.leave_history',compact('title','dep'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_leave_record(){
        $user= Auth::user();
        foreach ($user->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->id == 3) {
                        foreach ($d_user->applications as $application) {
                            if ($application->delete_status == 2) {
                                $application->delete_status = 3;
                                $application->save();
                            }
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('msg', 'All the current application records are deleted successfully! You can find this records in leave history now.');
    }

    public function delete_leave_history(){
        $user= Auth::user();
        foreach ($user->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->id == 3) {
                        foreach ($d_user->applications as $application) {
                            if ($application->delete_status == 3) {
                                foreach ($application->images as $image) {
                                    $image_path = "images/".$image->path;
                                    if(File::exists($image_path)) {
                                        File::delete($image_path);
                                    }
                                    $image->delete();
                                }
                                $application->images()->detach();  
                                $application->users()->detach(); 
                                $application->delete();
                            }
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('msg', 'All the all the leave histories are deleted successfully!');
    }
}
