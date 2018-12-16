@extends('layouts.app')
@section('content')

        <div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">
                <h1>Create new task</h1>

        <!-- Example row of columns -->
        
        <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color:white; margin:10px">
        <form method="post" action="{{ route('tasks.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="task-name">Name<span class="required">*</span></label>
                    <input placeholder="Enter name"
                            id="task-name"
                            required
                            name="name"
                            spellcheck="false"
                            class="form-control"
                    />
                </div>

                @if($companies == null)
                        <input class="form-control" type="hidden"
                                name="company_id"
                                value="{{ $company_id }}"
                        />
                @endif

                @if($companies != null)
                        <div class="form-group">
                                <label for="company-content">Select Company</label>
                                <select name="project_id" class="form-control">
                                        @foreach($companies as $company)
                                <option value="{{ $company->id }}"> {{ $company->name }} </option> 
                                        @endforeach       
                                </select>                    
                        </div> 
                @endif                      

                @if($projects == null)
                        <input class="form-control" type="hidden"
                                name="project_id"
                                value="{{ $project_id }}"
                        />
                @endif

                @if($projects != null)
                        <div class="form-group">
                                <label for="company-content">Select Project</label>
                                <select name="project_id" class="form-control">
                                        @foreach($projects as $project)
                                <option value="{{ $project->id }}"> {{ $project->name }} </option> 
                                        @endforeach       
                                </select>                    
                        </div> 
                @endif         
        
                                
                        <div class="form-group">
                            <input type="submit" class="btn" style="background-color:darkslateblue; color:white;"
                                value="submit">
                        </div>
                </form>
        
                </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
            <!--<div class="sidebar-module sidebar-module-inset">
              <h4>About</h4>
              <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>-->

            <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                    <li><a href="/tasks">Tasks</a></li>
                    
                    </ol>
                  </div>
          </div>
 
  @endsection