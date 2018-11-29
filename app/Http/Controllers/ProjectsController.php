<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::check() && Auth::user()->role_id == 3){
        //     $projects = Project::where('user_id', Auth::user()->id)->get();
        //     //Pass view to laravel
        //     return view('projects.index', ['projects'=>$projects]);
        // }
        // elseif(Auth::user()->role_id < 3){
        //     $projects = Project::all();  //Display all project
        //     return view('projects.index', ['projects' => $projects]);
        // }
        // return view('auth.login');

        

        
        if(Auth::user()->role_id < 3){
            $projects = Project::all();  //Display all project
            return view('projects.index', ['projects' => $projects]);
        }
        
        elseif(Auth::check()){
            $projects = Project::where('user_id', Auth::user()->id)->get();
            //Pass view to laravel
            return view('projects.index', ['projects'=>$projects]);
        }
        
        return view('auth.login');

    }

    public function adduser(Request $request){
        //add user to projects

        //Take a project and add a user to it
        $project = Project::find($request->input('project_id'));
        
        
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); //Single record
            if($user === null){
                return redirect()->route('projects.show', ['project'=> $project->id])->
                with('success', 'Error '.$request->input('email').' is not a registered staff');
            }
            //Check if user has been added to project
            $projectUser = ProjectUser::where('user_id', $user->id)->where('project_id', $project->id)->first();

            if($projectUser){
                //If user already exist
                return redirect()->route('projects.show', ['project'=> $project->id])->
                with('success', 'Error '.$request->input('email').' already exist in project!');

                // return response()->json(['success' ,  $request->input('email').' is already a member of this project']);

            }

            if($user && $project){
                $project->users()->attach($user->id);
                return redirect()->route('projects.show', ['project'=> $project->id])->
                with('sucess', $request->input('email').'user added already');

                // return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
            }
        }

        return redirect()->route('projects.show', ['project'=> $project->id])->
        with('errors', 'Error adding user to project!');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }

        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),                
                'user_id' => Auth::user()->id
            ]);



            if($project){
                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success', 'Project created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error in creating new Project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $company = $project->company;
        
        $company = Company::find($company->id);
        
        $project = Project::find($project->id);

        $comments = $project->comments;

        return view('projects.show', ['project'=>$project, 'comments'=> $comments, 'company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);
        return view('projects.edit', ['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $ProjectUpdate = Project::where('id', $project->id)->update([
            "name"=> $request->input('name'),
            "description"=> $request->input('description')
        ]);

        if($ProjectUpdate){
            return redirect()->route('projects.show', ['project'=>$project->id])->with('success', 'Project update successful');
        }
        //redirect 
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $findProject = Project::find( $project->id);
        if($findProject->delete()){

           //redirect
           return redirect()->route('projects.index')
           ->with('success', 'Project deleted successfully');
        }

        return back()->withInput()->with('errors', 'Project could not be deleted');
    }
}
