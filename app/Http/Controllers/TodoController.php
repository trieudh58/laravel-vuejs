<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

use App\Http\Requests;

class TodoController extends Controller
{
    public function show()
    {
        return view('todo.show');
    }

    public function get()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
//        dd($todos->toJson());
//        return json_encode($todos);
        return $todos->toJson();
    }
    public function create(Request $request)
    {
        $todo = new Todo();
        $todo->name = $request->input('name');
        $todo->description = $request->input('description');
        $todo->usesTimestamps();
        $todo->save();
        return $todo->toJson();
    }
}
