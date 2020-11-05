<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Rules\CheckPassword;
use App\Batch;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        $title= "SLMS | Edit Profile";

        foreach ($user->roles as $role) {
            if ($role->id == 3) {
                foreach ($user->departments as $department) {
                    $dep = $department;
                }
                foreach ($user->batches as $batch) {
                    $ba = $batch;
                }
                return view('student_pages/settings/edit_profile', compact('user','title','dep','ba'));
            }else{
                return view('admin_pages/settings/edit_profile', compact('user','title'));
            }
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user= Auth::user();
        $title= "SLMS | Change Password";
        foreach ($user->roles as $role) {
            if ($role->id == 3) {
                return view('student_pages/settings/change_password', compact('user','title'));
            }else{
                return view('admin_pages/settings/change_password', compact('user','title'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        foreach ($user->roles as $role) {
            if ($role->id == 3) {
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'batch' => 'required',
                    'roll' => 'required|max:6',
                ]);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                $user->batches()->sync($request->batch);
                
                $user->rolls->name = $request->roll;
                $user->rolls->save();

                return redirect()->back()->with('msg', 'Profile updated successfully!!');
            }
            else{
                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                ]);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                return redirect()->back()->with('msg', 'Profile updated successfully!!');
            }
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
        $request->validate([
          'old_password' => ['required', new CheckPassword],
          'new_password' => ['required', 'min:5'],
          'confirm_password' => ['required', 'min:5']
        ]);

        $user= Auth::user();
        $new_password= $request->new_password;
        $confirm_password= $request->confirm_password;

        if ($new_password==$confirm_password) {
            $user->password = Hash::make($confirm_password);
            $user->save();
            return redirect()->back()->with('msg', 'Password changed Successfully!!');
        }else{
            return redirect()->back()->with('msg2', 'Password hasn\'t matched!!');
        }
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
