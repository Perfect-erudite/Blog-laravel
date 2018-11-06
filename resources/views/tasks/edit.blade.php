@extends('layouts.app')
@section('content')

        <div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">
                <h1>Update task</h1>


        <!-- Example row of columns -->
        
        <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color:white; margin:10px">
        <form method="post" action="{{ route('tasks.update',[$task->id]) }}">
                {{ csrf_field() }}      
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="task-name">Name<span class="required">*</span></label>
                    <input placeholder="Enter name"
                            id="task-name"
                            required
                            name="name"
                            spellcheck="false"
                            class="form-control"
                            value="{{ $task->name }}"
                    />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary"
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
                    <li><a href="/tasks/{{$task->id}}">View task</a></li>
                    <li><a href="/tasks">All tasks</a></li>
                    
                    </ol>
                  </div>
          </div>
 
  @endsection