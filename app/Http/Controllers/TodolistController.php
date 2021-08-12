<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\todo_list;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TodolistController extends Controller
{
    public function index(Request $request)
    {   
        $data = User::select()->distinct()->get();
        $arr=[];
        $finalarray=[];
        
        foreach($data as $d){
            $get_user_id=$d->id;
            $name=$d->name;
            $email=$d->email;

            $select="count('task_id') as alltask";
        
            $user_details_by_id_and_taskid = DB::table('todo_lists')
            ->select('id', DB::raw($select))
            ->where('id',$get_user_id)
            ->where('status',"1")
            ->where('completed',"no")
            ->groupBy('id')
            ->distinct()
            ->get();

            if(sizeof($user_details_by_id_and_taskid)!=0)
            {
                foreach($user_details_by_id_and_taskid as $d3 ){
                    $alltask=$d3->alltask;     
                }
            }
            else{
                $alltask=0;
            }
            

            $arr= (object)array();
            $arr->id=$get_user_id;
            $arr->name=$name;
            $arr->email=$email;
            $arr->alltask=$alltask;

            array_push($finalarray, $arr);
        }
 
        if(!empty($finalarray)){
            return Inertia::render('UsersList/list', ['user_list' => $finalarray]);
        }
        
        
    }

    public function get_task(Request $request)
    {   
        
        $user_id= Auth::users()->id;

        $data = DB::table('todo_lists')->select()->where('id', $user_id)->all();

        return Inertia::render('/dashboard', ['data' => $data]);
        
    }

    public function store(Request $request)
    {
        
        $task_name=$request->input('task_name');
        $user_id=$request->input('user_id');
        
  
        DB::table('todo_lists')->insert([
            'task_name'=>  $task_name,
            'id'=> $user_id,
            'status'=>"1",
            'completed'=>"no"
        ]);
  
        return redirect("/dashboard")->with('message', 'Task saved Successfully.');
                    
    }
  
    public function update(Request $request)
    {   
        $task_id=$request->input('task_id');
        $task_name=$request->input('task_name');
        $status=$request->input('status');
        $completed=$request->input('completed');
        $user_id=Auth::user()->id;
  
        if ($task_id != 0) {
            todo_list::where('task_id',$task_id)->where('id',$user_id)->update([
                'status'=> $status,
                'completed'=> $completed,
            ]);
            return redirect("/dashboard")->with('message', 'Task Updated Successfully.');
        }
    }
   
    public function destroy(Request $request)
    {   
        $task_id=$request->input('task_id');
        $status=$request->input('status');
        $user_id=Auth::user()->id;
  
        if ($task_id != 0) {
            todo_list::where('task_id',$task_id)->where('id',$user_id)->update([
                'status'=> $status,
            ]);
            return redirect("/dashboard")->with('message', 'Task Deleted Successfully.');
        }
       
    }

     // public function update(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'task_name' => ['required'],
    //     ])->validate();
  
    //     if ($request->has('task_id')) {
    //         todo_list::find($request->input('task_id'))->update($request->all());
    //         return redirect()->back()
    //                 ->with('message', 'Task Updated Successfully.');
    //     }
    // }

    
}
