<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(){
        $tasks->auth()->user()->tasks();
        return view('dashboard',compact('tasks'));
    }
    // How to add anything in DataBase 
    public function add(){
        return view('add');
    }
    // create a new collum in database 
     public function create(Request $request){
        $this->validate($request,[
            'description'=>'required'
        ]);
        $task=new Task();
        $task->description = $request->description;
        $task->user_id=auth()->user()->id;
        $task->save();
        return redirect('/dashboard'); 
     }
    //  edite a cloum in database 
    public function edit(Task $task){
        if(auth()->user()->id==$task->user_id){
            return view('edit',compact('task'));
        }
        else{
            return redirect('/dashboard');
        }
    }
    // Update any thing in database 
  public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, [
                'description' => 'required'
            ]);
    		$task->description = $request->description;
	    	$task->save();
	    	return redirect('/dashboard'); 
    	}    	
    }
}
