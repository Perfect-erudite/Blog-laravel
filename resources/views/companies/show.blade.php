@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <!-- The justified navigation menu is meant for single line per list item.
            Multiple lines will require custom code not provided by Bootstrap. -->
    

        <!-- Jumbotron -->
        <div class="jumbotron">
        <h1>{{ $company->name }}</h1>
        <p class="lead">{{ $company->description}}</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
        </div> 

        <!-- Example row of columns -->
        
        <div class="row" style="background-color:white; margin:10px">
            <a href="/projects/create/{{$company->id}}" class="pull-right btn btn-primary btn-sm">Add project</a>
            @foreach($company->projects as $project)
                <div class="col-lg-4">
                <h2>{{ $project->name}}</h2>
                    <p class="text-danger">{{$project->description}} </p>
                <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View project »</a></p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
            <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                    <li><a href="/companies/{{$company->id}}/edit"><i class="fas fa-edit"></i>Edit</a></li>
                    <li><a href="/projects/create/{{$company->id}}"><i class="fas fa-briefcase"></i>Add project</a></li>
                    <li><a href="/companies"><i class="fas fa-list-ul"></i>List of Companies</a></li>
                    <li><a href="/companies/create"><i class="fas fa-plus-circle"></i>Create new Company</a></li>                    

                    </br>
                    @if(Auth::user()->role_id == 1)
                      <li>
                        
                        <a 
                        href="#"
                            onclick="
                            var result = confirm('Are you sure you wish to delete this Company?');
                                if(result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();
                                }"
                        >
                        <i class="fas fa-trash-alt"></i>Delete
                        </a>
                        
                      <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"
                        method="POST" style="display: none";>
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                      </form>

                      
                      </li>
                      @endif
                    </ol>
                  </div>
            
          </div>
 
  @endsection