<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Mail;
use App\User;
use App\Image;
use App\Role;
use App\Application;
use Carbon\Carbon;
use App\Rules\CheckDate;

class StudentApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
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
            $dep= $department;
        }
        $title = "SLMS | Apply for Leave";
        return view('student_pages.apply_lec',compact('dep','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "SLMS | Apply for Leave";
        return view('student_pages.apply_head',compact('title'));
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
            'subject' => 'required|max:255',
            'from' => ['required', new CheckDate($request->to)],
            'to' => ['required'],
            'apply_to' => 'required',
            'description' => 'required',
        ]);

        $user= Auth::user();

        // --email functionalities--
        // $m_user = User::findOrFail($request->apply_to);
        // $name = $m_user->name;
        // $email = $m_user->email;
        // $data= [
        //     'user'=>$user,
        // ];
        // Mail::send('application_email', $data, function ($message) use($name,$email) {
        //     $message->to($email, $name)->subject('New Leave Request');
        // });

        $application= new Application;
        $application->subject= $request->subject;
        $application->from= $request->from;
        $application->to= $request->to;
        $application->description= $request->description;

        $user->applications()->save($application);
        $application->users()->attach($request->apply_to);

        //$date= date('Y_m_d')."_".date('H_i_s');
        $images = $request->file('images');

        if($request->hasFile('images'))
        {
            $count= 1;
            foreach ($images as $image) {
                // $name= $date.$image->getClientOriginalName();
                $name= $application->id."_".$count++."_".$image->getClientOriginalName();
                $image->move('images',$name);
                $image= new Image;
                $image->path= $name;
                $application->images()->save($image);
            }
        }

        return redirect()->back()->with('msg', 'Application sent successfully!!');
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
                if ($role->name != "student") {
                    $lec= $user;
                }
            }
        }

        $user= Auth::user();

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | Application";

        return view('student_pages.application', compact('application','user','lec','date','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);

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

        return redirect('/leave_history');
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


    public function store_head(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'from' => ['required', new CheckDate($request->to)],
            'to' => ['required'],
            'description' => 'required',
            'images.*' => 'required|mimes:jpeg,bmp,png|max:2000',
        ]);

        $user= Auth::user();

        foreach ($user->departments as $department) {
            foreach ($department->users as $dep_user) {
                foreach ($dep_user->roles as $role) {
                    if ($role->name == "admin") {
                        $admin_id = $dep_user->id;
                    }
                }
            }
        }

        // --email functionalities--
        // $m_user = User::findOrFail($admin_id);
        // $name = $m_user->name;
        // $email = $m_user->email;
        // $data= [
        //     'user'=>$user,
        // ];
        // Mail::send('application_email', $data, function ($message) use($name,$email) {
        //     $message->to($email, $name)->subject('New Leave Request');
        // });

        $application= new Application;
        $application->subject= $request->subject;
        $application->from= $request->from;
        $application->to= $request->to;
        $application->description= $request->description;

        $user->applications()->save($application);
        $application->users()->attach($admin_id);

        // $date= date('Y_m_d')."_".date('H_i_s');
        $images = $request->file('images');

        if($request->hasFile('images'))
        {
            $count= 1;
            foreach ($images as $image) {
                // $name= $date.$image->getClientOriginalName();
                $name= $application->id."_".$count++."_".$image->getClientOriginalName();
                $image->move('images',$name);
                $image= new Image;
                $image->path= $name;
                $application->images()->save($image);
            }
        }

        return redirect()->back()->with('msg', 'Application sent successfully!!');
    }

    public function current_leave(){
        $user= Auth::user();

        $mytime= Carbon::now(+6);
        $date= $mytime->toDateString();

        $title = "SLMS | Current Leave";

        return view('student_pages.current_leave', compact('user','date','title'));
    }

    public function leave_history(){
        $user= Auth::user();

        $title = "SLMS | Leave History";

        return view('student_pages.leave_history', compact('user','title'));
    }
}
