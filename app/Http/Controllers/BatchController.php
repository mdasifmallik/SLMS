<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Batch;
use App\User;

class BatchController extends Controller
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
            $dep= $department;
        }

        $title = "SLMS | Batch";

        return view('admin_pages.batch.batch_list',compact('title','dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "SLMS | Add Batch";

        return view('admin_pages.batch.add_batch',compact('title'));
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
            'batch_name' => ['required', 'unique:batches,name'],
        ]);

        $batch= new Batch;
        $batch->name= $request->batch_name;

        $user= Auth::user();

        foreach ($user->departments as $department) {
            $department->batches()->save($batch);
        }

        return redirect()->back()->with('msg', 'New Batch added successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batch= Batch::findOrFail($id);

        $title = "SLMS | Batch ".$batch->name;

        return view('admin_pages.batch.students',compact('title','batch'));
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


    public function delete_student($id){
        $user = User::findOrFail($id);

        $user->roles()->detach();
        $user->departments()->detach();

        foreach ($user->applications as $application) {
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

        $user->batches()->detach();
        $user->delete();

        return redirect()->back()->with('msg', 'Student deleted successfully!!');
    }

    public function delete_batch($id){
        $batch = Batch::findOrFail($id);

        foreach ($batch->users as $user) {
            foreach ($user->applications as $application) {
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
            $user->batches()->detach();
            $user->delete();
        }
        $batch->departments()->detach();
        $batch->delete();

        session()->flash('msg' , 'Batch deleted successfully!!');
        return redirect('/batch');
    }
}
