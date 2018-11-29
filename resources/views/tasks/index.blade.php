{{-- connects the index page to the main page layout --}}
@extends('layouts.app')
@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
   

    {{-- @if(isset($task->id)) --}}
        <div class="panel panel-default">
                <div class="panel-heading">Tasks<a class="pull-right btn btn-default btn-sm" style="color:black; " href="/tasks/create">Create new</a></div>
            <div class='panel-body'>
                    @if ($tasks->isEmpty())
                        <h1>NO TASK CREATED</h1></br>
                    @else
                        <ul class="list-group">
                            {{-- Displays the list of tasks present in the database --}}
                            @foreach($tasks as $task)
                                {{-- List the tasks and makes it a link to show the task page --}}
                                <li class="list-group-item"><a href="/tasks/{{$task->id}}">{{$task->name}}</a></li>
                            @endforeach  
                        </ul>
                    @endif
            </div>
        </div>

    {{-- @else
        <h1>NO TASK CREATED</h1></br>
        <a class="pull-right btn btn-primary btn-sm" href="/tasks/create">Create new Task</a></div>

        @endif --}}
    </div>
    

        {{-- <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Panel heading</div>
            
                <!-- Table -->
                <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email </th>
                </tr>
                </table>
            </div> --}}
@endsection