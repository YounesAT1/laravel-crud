<?php

namespace App\Http\Controllers;


use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class DeveloperController extends Controller
{
    public function index() {
        // $developers = Developer::all();
        $developers = Developer::select('developers.*')
                    ->selectRaw('(SELECT SUM(durationHours * priceHour) FROM tasks WHERE developers.idD = tasks.idD ) AS totalRevenue ')
                    ->get();
        return view('developer.index', compact('developers'));
    }

    public function create()
    {
        return view('developer.create');
    }

    protected function handlePictureUpload(Request $request){
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

    protected function validateAddDeveloper(Request $request) {
        return $request->validate([
            'firstName'=> 'required|max:255|string',
            'lastName'=> 'required|max:255|string',
            'picture'=> 'required|file|mimes:jpg,jpeg,png|max:5120',
            'cv'=> 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'firstName.required' => 'First Name is required',
            'firstName.max' => 'First name should not be greater than 255 characters',
            'lastName.required' => 'Last Name is required',
            'lastName.max' => 'Last name should not be greater than 255 characters',
            'picture.required' => 'The picture is required',
            'cv.required' => 'The CV is required',
        ]);
    }

    protected function validateUpdateDeveloper(Request $request) {
        return $request->validate([
            'firstName'=> 'required|max:255|string',
            'lastName'=> 'required|max:255|string',
            'picture'=> 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'cv'=> 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'firstName.required' => 'First Name is required',
            'firstName.max' => 'First name should not be greater than 255 characters',
            'lastName.required' => 'Last Name is required',
            'lastName.max' => 'Last name should not be greater than 255 characters',
        ]);
    }

    public function handleCvUpload (Request $request){
        $file = $request->file('cv');
        $fileExtension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();

        if(!in_array($fileExtension, ['pdf', 'doc', 'docx']) || $fileSize > 5120000){
            return back()->with('status', 'The file should be pdf, doc, or docx and should not be larger than 5MB');
        }

        $folder = 'documents';
        $token = uniqid();
        $documentSrc = $folder.'/'.$token.'-'.$file->getClientOriginalName();
        $file->move($folder, $token . '-' . $file->getClientOriginalName());

        return $documentSrc;

    }

    public function store(Request $request) {
        $this->validateAddDeveloper($request);

        $pictureSrc = $this->handlePictureUpload($request);
        $cvSrc = $this->handleCvUpload($request);

        $developer = $request->post();
        $developer['picture'] = $pictureSrc;
        $developer['cv'] = $cvSrc;

        try {
            Developer::create($developer);
            return redirect()->route('developers.index')->with('status', 'Developer has been successfully added!');
        } catch (\Exception) {
            return back()->with('status', 'Faild to add the developer somthing went wrong!!');
        }
    }

    public function edit (Developer $developer){
        return view('developer.edit', compact('developer'));
    }

    public function update (Request $request, Developer $developer) {
        $validatedData = $this->validateUpdateDeveloper($request);

        if ($request -> hasFile('picture') ){
            $developer->picture = $this->handlePictureUpload($request);
        }
        
        if ( $request ->hasFile('cv')){
            $developer->cv = $this->handleCvUpload($request);

        }

        $developer->firstName = $validatedData['firstName'];
        $developer->lastName = $validatedData['lastName'];

        try {
            $developer->save();
            return redirect()->route('developers.index')->with('status', $developer->firstName.' has been successfully updated');
        }catch(\Exception){
            return back()->with('status', 'Failed to update the Developer something went wrong!!');
        }
    }

    public function destroy(Developer $developer)
    {
        $developer->delete();
        return redirect()->route('developers.index')->with('status', $developer->firstName.' has been successfully deleted!');
    }

    public function details (Developer $developer) {
        $dev = Developer::with(['tasks'])->find($developer->idD);
        

        return view('developer.details', compact('dev'));
    }

    public function searchTasks(Request $request){
        $validator = Validator::make($request->all(), [
            'searchTasks' => 'required|string',
        ],[
            'searchTasks.required' => 'Choose a developer'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $firstName = $request->input('searchTasks');
        $tasks = DB::select('
        SELECT tasks.idT, tasks.durationHours, tasks.priceHour, tasks.state, tasks.created_at, tasks.updated_at
        FROM tasks
        INNER JOIN developers ON tasks.idD = developers.idD
        WHERE developers.firstName = :firstName', [$firstName]);    
        
        return view('developer.searchTasks', compact('tasks', 'firstName'));
    }

    public function searchProjects(Request $request){
        $validator = Validator::make($request->all(), [
            'searchProjects' => 'required|string',
        ], [
            'searchProjects.required' => 'Choose a developer'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $firstName = $request->input('searchProjects'); 
        $projects = DB::select('
            SELECT projects.idP, projects.name, projects.description, projects.picture AS project_picture, projects.created_at, projects.updated_at
            FROM projects
            INNER JOIN tasks ON projects.idP = tasks.idP
            INNER JOIN developers ON tasks.idD = developers.idD
            WHERE developers.firstName = :firstName', [$firstName]);
    
        return view('developer.searchProjects', compact('projects', 'firstName'));
    }
    
    
}
