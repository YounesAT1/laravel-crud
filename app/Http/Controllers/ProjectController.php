<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::select('projects.*')
        ->selectRaw('(SELECT SUM(durationHours * priceHour) FROM tasks WHERE projects.idP = tasks.idP) as totalCost')
        ->get();



        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    protected function validateAddProject(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'picture' => 'required|file',
        ], [
            'name.required' => 'Project name is required',
            'name.max' => 'Project name should not be greater than 255 characters',
            'description.required' => 'Project description is required',
            'description.max' => 'Project description should not be greater than 255 characters',
            'picture.required' => 'Project picture is required',
        ]);
    }

    protected function validateUpdateProject(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'picture' => 'nullable|file',
        ], [
            'name.required' => 'Project name is required',
            'name.max' => 'Project name should not be greater than 255 characters',
            'description.required' => 'Project description is required',
            'description.max' => 'Project description should not be greater than 255 characters',
        ]);
    }

    protected function handlePictureLogic(Request $request)
    {
        $file = $request->file('picture');
        $fileExtension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();

        if (!in_array($fileExtension, ['jpg', 'jpeg', 'png']) || $fileSize > 5120000) {
            return back()->with('status', 'The image should be png, jpeg, or jpg and should not be larger than 5MB');
        }

        $folder = 'pictures';
        $token = uniqid();
        $pictureSrc = $folder . '/' . $token . '-' . $file->getClientOriginalName();

        $file->move($folder, $token . '-' . $file->getClientOriginalName());

        return $pictureSrc;
    }


    public function store(Request $request)
    {
        $this->validateAddProject($request);

        $pictureSrc = $this->handlePictureLogic($request);

        $project = $request->post();
        $project['picture'] = $pictureSrc;

        try {
            Project::create($project);
            return redirect()->route('projects.index')->with('status', 'The project has been successfully added!');
        } catch (\Exception) {
            return back()->with('status', 'Failed to create the project. Please try again.');
        }
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $this->validateUpdateProject($request);

        if ($request->hasFile('picture')) {
            $project->picture = $this->handlePictureLogic($request);
        }

        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];

        try {
            $project->save();
            return redirect()->route('projects.index')->with('status', 'The project has been successfully updated!');
        } catch (\Exception) {
            return back()->with('status', 'Failed to update the project. Please try again.');
        }
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('status', 'The project has been successfully deleted!');
    }

    public function details (Project $project) {
    
        $projectId = $project->idP;
        $projectDetails = Project::with(['tasks.developer'])->where('idP', $projectId)->get();
        return view('project.details', compact('projectDetails', 'project'));
    }


    public function searchTasks(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'searchTasks' => 'required|string',
        ],[
            'searchTasks.required' => 'Choose a project'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }

        $projectId = $request->input('searchTasks');
        $project = Project::find($projectId);

        $searchResults = $project->tasks;
        

        return view('project.search', compact('searchResults', 'project'));
        
    }
}
