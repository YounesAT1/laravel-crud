<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['project', 'developer'])->get();
        $projects = Project::all(); 

        return view('task.index', compact('tasks', 'projects'));
    }


    public function create()
    {
        $projects = Project::all();
        $developers = Developer::all();

        return view('task.create', compact('projects', 'developers'));
    }

    public function store (Request $request) {
        $validatedData = $request->validate([
            'idP' => 'required',
            'idD' => 'required',
            'durationHours' => 'required|numeric',
            'priceHour' => 'required|numeric',
            'state' => 'required',
        ],[
            'idP.required' => 'Select a project name',
            'idD.required' => 'Select a developer name',
            'idP.durationHours' => 'Duration is required',
            'idP.priceHour' => 'Price is required',
            'idP.state' => 'Select a state',
            
        ]);

        Task::create($validatedData);
        return redirect()->route('tasks.index')->with('status', 'Task added successfully!');
        
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        $developers = Developer::all();

        $task = Task::with(['project', 'developer'])->find($task->idT); 

        return view('task.edit', compact('task', 'projects', 'developers'));
    }

    public function update(Request $request, Task $task) {
        $validatedData = $request->validate([
            'idP' => 'required',
            'idD' => 'required',
            'durationHours' => 'required|numeric',
            'priceHour' => 'required|numeric',
            'state' => 'required',
        ],[
            'idP.required' => 'Select a project name',
            'idD.required' => 'Select a developer name',
            'idP.durationHours' => 'Duration is required',
            'idP.priceHour' => 'Price is required',
            'idP.state' => 'Select a state',
            
        ]);

        $task->update($validatedData);
        return redirect()->route('tasks.index')->with('status', 'Task updated successfully!');
 
    }

    public function destroy(Task $task) {
        $task -> delete();
        return redirect()->route('tasks.index')->with('status', 'Task deletd successfully!');
    }

    public function details (Task $task) {
        $task = Task::with(['project', 'developer'])->find($task->idT);
        return view('task.details', compact('task'));
    }

    
}
