@extends('layouts.app')
@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    {{-- @if(isset($project)) --}}
    <div class="panel panel-default">
        <div class="panel-heading">Projects<a class="pull-right btn btn-default btn-sm" style="color:black;" href="/projects/create">Create new</a>
        </div>
        <div class='panel-body'>
            @if ($projects->isEmpty())
                <h1>NO PROJECT CREATED</h1></br>
            @else
                <ul class="list-group">
                    {{-- Displays the list of projectss present in the database --}}
                    @foreach($projects as $project)
                        {{-- List the projects and makes it a link to show the project page --}}
                         <li class="list-group-item"><i class="fas fa-caret-right"></i><a href="/projects/{{$project->id}}">{{$project->name}}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    {{-- @else
    <h1>NO PROJECT CREATED</h1></br>
    <a class="pull-right btn btn-primary btn-sm" href="/projects/create">Create new Project</a></div>

    @endif --}}
</div>

@endsection


