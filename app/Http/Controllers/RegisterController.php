<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\User;
use App\Role;
use App\Batch;
use App\Roll;
use Hash;
use App\Rules\CheckCode;
use App\Rules\StudentCheckCode;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Department::all();
        return view('register',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department' => ['required', 'max:255', 'unique:departments,name'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $department= new Department;
        $department->name= $request->department;
        $department->save();

        $user= new User;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);

        $department->users()->save($user);

        $user->roles()->attach(1);

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department= Department::findOrFail($id);

        echo "<label>Batch: </label>";
        echo "<select name=\"batch\"> class=\"form-control\"";
        echo "<option value=\"\">Choose Batch</option>";
        foreach ($department->batches as $batch) {
            echo "<option value=\"".$batch->id."\">".$batch->name."</option>";
        }
        echo "</select>";
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

    public function register_lecturer()
    {
        return view('lecturer-register');
    }

    public function store_lecturer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department_code' => ['required', 'max:255', new CheckCode],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $department= Department::where('lec_code',$request->department_code)->first();

        $user= new User;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);

        $department->users()->save($user);

        $user->roles()->attach(2);

        return redirect('/login');
    }

    public function store_student(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'batch' => ['required'],
            'roll' => ['required'],
            'verification_code' => ['required', new StudentCheckCode],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $department= Department::where('stu_code',$request->verification_code)->first();

        $user= new User;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);

        $department->users()->save($user);

        $roll= new Roll;
        $roll->name= $request->roll;
        $user->rolls()->save($roll);

        $user->roles()->attach(3);
        $user->batches()->attach($request->batch);

        return redirect('/login');
    }
    
}
