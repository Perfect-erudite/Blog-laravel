<?php

namespace App\Http\Controllers;
use App\Task;
use App\Project;
use App\Company;
use App\TaskUser;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Check if user is login

        // if(Auth::check()){
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('tasks.index', ['tasks'=>$tasks]);
        // }
        //ask user to login
        // return('auth.login');
    }


    public function adduser(Request $request){
        //add user to projects

        //Take a project and add a user to it
        $task = task::find($request->input('task_id'));
        
        
        if(Auth::user()->id == $task->user_id){
            $user = User::where('email', $request->input('email'))->first(); //Single record
            if($user === null){
                return redirect()->route('tasks.show', ['task'=> $task->id])->
                with('success', 'Error '.$request->input('email').' is not a registered staff');
            }
            //Check if user has been added to project
            $taskUser = TaskUser::where('user_id', $user->id)->where('task_id', $task->id)->first();

            if($taskUser){
                //If user already exist
                return redirect()->route('tasks.show', ['task'=> $task->id])->
                with('success', 'Error '.$request->input('email').' already exist in task!');

                // return response()->json(['success' ,  $request->input('email').' is already a member of this task']);

            }

            if($user && $task){
                $task->users()->attach($user->id);
                return redirect()->route('tasks.show', ['task'=> $task->id])->
                with('sucess', $request->input('email').'user added already');

                // return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
            }
        }

        return redirect()->route('tasks.show', ['task'=> $task->id])->
        with('errors', 'Error adding user to task!');
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id = null, $company_id = null)
    {
        //
        $projects = null;
        $companies = null;

        if(!$project_id || !$company_id){
            $projects = Project::where('user_id', Auth::user()->id)->get();
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }

        return view('tasks.create', ['project_id'=>$project_id, 'projects'=>$projects], 
        ['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $task = Task::create([
                'name' => $request->input('name'),
                'project_id' => $request->input('project_id'),
                'company_id' => $request->input('company_id'),                
                'user_id' => Auth::user()->id
            ]);



            if($task){
                return redirect()->route('tasks.show', ['task'=>$task->id])
                ->with('success', 'Task created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error in creating new Task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //Get this particular task id
        $task = Task::find($task->id);

        return view('tasks.show', ['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        $task = Task::find($task->id);
        return view('tasks.edit', ['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $TaskUpdate = Task::where('id', $task->id)->update([
            "name"=> $request->input('name')
        ]);

        if($TaskUpdate){
            return redirect()->route('tasks.show', ['task'=>$task->id])->with('success', 'Task updated successful');
        }
        //redirect 
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $findTask = Task::find( $task->id);
        if($findTask->delete()){

           //redirect
           return redirect()->route('tasks.index')
           ->with('success', 'Task deleted successfully');
        }

        return back()->withInput()->with('errors', 'Task could not be deleted');
    }
}
