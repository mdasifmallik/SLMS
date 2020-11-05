<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Department;

class DepartmentController extends Controller
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

        $title = "SLMS | Department Code";
        
        return view('admin_pages.department.department_code',compact('title','dep'));
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

        $title = "SLMS | Edit Department";

        return view('admin_pages.department.edit_department',compact('title','dep'));
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
        $department= Department::findOrFail($id);
        $request->validate([
            'department_name' => 'required|unique:departments,name,'.$department->id,
        ]);
        if ($request->lecturers_code) {
            $request->validate([
                'lecturers_code' => 'unique:departments,lec_code,'.$department->id,
            ]);
        }
        if ($request->students_code) {
            $request->validate([
                'students_code' => 'unique:departments,stu_code,'.$department->id,
            ]);
        }

        $department->name = $request->department_name;
        $department->lec_code = $request->lecturers_code;
        $department->stu_code = $request->students_code;
        $department->save();

        return redirect()->back()->with('msg', 'Department info updated successfully!!');
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
