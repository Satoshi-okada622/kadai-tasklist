<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; 

class UsersController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
    
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        $user->loadRelationshipCounts();

        return view('tasks.show', [
            'task' => $task,
        ]);
    }    
}
