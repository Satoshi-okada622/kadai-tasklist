<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index()
    {   
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            
            return view('tasks.index', $data);
        }
        
        // return redirect('login');
    }

    public function create()
    {
        $task = new Task;
        
       
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    public function store(Request $request)
    {
        var_dump($request->all());
        $request->validate([
            'status' => 'required|max:10',   
            'content' => 'required|max:255',
        ]);
        
        // $request->user()->tasks()->create([
        //     'content' => $request->content,
        // ]);

        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        // $tasks->user_id = auth()->id();
        $task->user_id = $request->user()->id;
        $task->save();
        
        return redirect('/');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);

    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|max:10',  
            'content' => 'required|max:255',
        ]);
        
        $task = Task::findOrFail($id);
        
        $task->status = $request->status; 
        $task->content = $request->content;
        $task->user_id = $request->user()->id;
        $task->save();
        
        
        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return redirect('/');
    }
}



?>