<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Session;
class TaskController extends Controller
{
    public function show($id)
    {
        $data=Task::findOrFail($id);
        return view('taskupdate',compact('data'));
    }
    public function view_manage_staff()
    {
        $data=Task::all();
        return view('staff.view-manage-staff',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data=Task::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $data->status=$request->status;
        $data->save();
        if(Session::has('stafflogin')){
            $userId = '';
                $users =\Session::get('data');
                foreach($users as $user){
                    $userId = $user->id;
                }
        $staffTask= Task::where('title',$userId)->get();
        return view('view-task')->with('staff_tasks',$staffTask);
 
        }else{
            return redirect('/');
        }
    }
}
