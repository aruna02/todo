<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo; 

class TodoController extends Controller
{
    public function index($status)
    {
    	$id = auth()->user()->id;

        $todos = Todo::orderBy('id','DESC')->where('user_id',$id)->get();


    	if($status != 2) {
    		$todos = Todo::orderBy('id','DESC')->where('user_id',$id)->where('status',$status)->get();
    	}
        
    	
    	return view('todo.list',compact('todos'));
    }

    public function add($data)
    {
       $value['user_id'] = auth()->user()->id;
       $value['description'] = $data;
       $todo = Todo::create($value);
       return('todo added successfully');
    }

    public function updateTodo(Request $request)
    {
    	$data = $request->all();
    	$id = $data['id'];
    	if(isset($data['date']))
    	{
    		$date['scheduled_date'] = $data['date'];
    	}
    	if(isset($data['status']))
    	{
    		$date['status'] = $data['status'];
    	}
    	if(isset($data['description']))
    	{
    		$date['description'] = $data['description'];
    	}
       	$todo = Todo::find($id);
      	$todo->update($date);
      	return('todo updated successfully');
      	
       
    }

    public function delete(Request $request)
    {
    	$data = $request->all();
    	$id = $data['id'];
    	$todo = Todo::find($id);
    	$todo->delete();
    	return('todo deleted successfully');
    }

    public function searchByName($data)
    {
    	
    	$todos = Todo::where('description','like','%'.$data.'%')
    			->where('user_id',auth()->user()->id)->get();
    	return view('todo.list',compact('todos'));
    	
    }

}
