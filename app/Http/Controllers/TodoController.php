<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        Todo::create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }
    
    public function destroy($id)
{
    Todo::findOrFail($id)->delete();
    return redirect()->back();
}

public function edit($id)
{
    $todo = Todo::findOrFail($id);
    return view('todos.edit', compact('todo'));
}

public function update(Request $request, $id)
{
    $todo = Todo::findOrFail($id);
    $todo->update(['title' => $request->title]);
    return redirect('/todos');
}



}
