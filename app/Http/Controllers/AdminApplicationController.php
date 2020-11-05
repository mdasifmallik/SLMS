<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Department;
use App\Application;
use Carbon\Carbon;

class AdminApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lecturer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d_lec= Auth::user();
        foreach ($d_lec->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        $title = "SLMS | All Leaves";

        return view('admin_pages.all_leaves.all_leaves',compact('title','d_lec','d_head'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $d_lec= Auth::user();
        foreach ($d_lec->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | Pending Leaves";

        return view('admin_pages.leaves.pending_leaves',compact('title','d_lec','d_head','date'));
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
        $application= Application::findOrFail($id);

        foreach ($application->users as $user) {
            foreach ($user->roles as $role) {
                if ($role->name == "student") {
                    $stu= $user;
                }else{
                    $lec= $user;
                }
            }
        }

        $user= Auth::user();

        foreach ($stu->batches as $batch) {
            $ba= $batch;
        }

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | ".$application->subject;

        return view('admin_pages.application.application', compact('title','application','user','stu','lec','ba','date'));
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


    public function approve($id)
    {
        $application= Application::findOrFail($id);

        $application->status = "3";
        $application->save();

        return redirect()->back()->with('msg', 'Application approved successfully!!');
    }

    public function decline($id)
    {
        $application= Application::findOrFail($id);

        $application->status = "4";
        $application->save();

        return redirect()->back()->with('msg', 'Application declined successfully!!');
    }

    public function approved_leaves()
    {
        $d_lec= Auth::user();
        foreach ($d_lec->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | Approved Leaves";

        return view('admin_pages.leaves.approved_leaves',compact('title','d_lec','d_head','date'));
    }

    public function not_approved_leaves()
    {
        $d_lec= Auth::user();
        foreach ($d_lec->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | Not Approved Leaves";

        return view('admin_pages.leaves.not_approved_leaves',compact('title','d_lec','d_head','date'));
    }

    public function on_leave()
    {
        $d_lec= Auth::user();
        foreach ($d_lec->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | On Leave";

        return view('admin_pages.on_leaves.on_leave',compact('title','d_lec','d_head','date'));
    }
    
}
