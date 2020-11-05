<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AdmindashController extends Controller
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
        $user= Auth::user();

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $all=0;
        $current=0;
        $pending=0;
        $approved=0;
        $declined=0;

        foreach ($user->departments as $department) {
            foreach ($department->users as $d_user) {
                foreach ($d_user->roles as $role) {
                    if ($role->name == "admin") {
                        $d_head = $d_user;
                    }
                }
            }
        }

        foreach ($user->applications as $application) {
            if ($application->delete_status == 2) {
                $all++;
                if ($application->status == 2) {
                    $pending++;
                }elseif ($application->status == 3) {
                    $approved++;
                }elseif ($application->status ==4) {
                    $declined++;
                }
                if ($application->from <= $date && $application->to >= $date && $application->status == 3) {
                    $current++;
                }
            }
        }

        if ($user->id != $d_head->id) {
            foreach ($d_head->applications as $application) {
                if ($application->delete_status == 2) {
                    $all++;
                    if ($application->from <= $date && $application->to >= $date && $application->status == 3) {
                        $current++;
                    }
                }
            }
        }

        $title = "SLMS | Dashboard";

        return view('admin_pages.admin_dash.admin_dash',compact('title','all','current','pending','approved','declined'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $files= $request->file('images');

        foreach ($files as $file) {
            echo $file->getClientOriginalName();
        }
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
}
