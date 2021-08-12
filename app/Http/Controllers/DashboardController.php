<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\todo_list;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {   
        $data1 = User::all();
        $user_id= Auth::user()->id;

        $user_details_by_id = DB::table('users')->select()->where('id', $user_id)->first();

        $data = DB::table('todo_lists')->select()->where('id', $user_id)->where('status',"1")->get();
        
        return Inertia::render('Dashboard/index', ['user' => $data1, 'list' => $data ,'user_id'=>$user_id, 'user_details'=>$user_details_by_id]);
    }
    public function store(Request $request)
    {
        
        $task_name=$request->input('task_name');
        $user_id=$request->input('user_id');
        
  
        DB::table('todo_lists')->insert([
            'task_name'=>  $task_name,
            'id'=> $user_id,
            'status'=>"1"
        ]);
  
        return redirect("Dashboard/index")->with('message', 'Task Saved Successfully.');
                    
    }

    
}
