<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
     public function index()
    {    
        $messages = Message::all();

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    public function create()
    {
        $message = new Message;

            return view('messages.create', [
            'message' => $message,
            ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('messages.show', [
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);

            return view('messages.edit', [
            'message' => $message,
        ]);

    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

