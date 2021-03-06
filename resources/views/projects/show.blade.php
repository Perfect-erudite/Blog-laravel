@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <!-- The justified navigation menu is meant for single line per list item.
            Multiple lines will require custom code not provided by Bootstrap. -->
    

        <!-- Jumbotron -->
        <div class="well well-lg" style="background-image:linear-gradient(white, rebeccapurple);">
            <h1 style="color:yellow;">{{ $project->name }}</h1>
            <p class="lead" style="color:white;">{{ $project->description}}</p>
            <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
        </div> 

        <!-- Example row of columns -->
        
        <div class="row" style="margin:10px">
            <a href="/tasks/create/{{$project->id}}" class="pull-right btn btn-sm" style="background-color:darkslateblue; color:white;">Add task</a>
                    @foreach($project->tasks as $task)
                        <div class="col-lg-4">
                            <h2 style="color:black;">{{ $task->name}}</h2>
                            <p><a class="btn" style="background-color:darkslateblue; color:white;" href="/tasks/{{$task->id}}" role="button">View task »</a></p>
                        </div>
                    @endforeach
                    <br/>

        </div>

            <div class="row container-fluid">
                <form method="post" action="{{ route('comments.store') }}">
                    {{ csrf_field() }}

                            <input type="hidden" name="commentable_type" value="App\Project"/>
                            <input type="hidden" name="commentable_id" value="{{$project->id}}"/>
                            
                        <div class="form-group">
                            <label for="comment-content">Comment</label>
                            <textarea placeholder="Enter comment"
                                style="resize:vertical"
                                id="comment-content"
                                name="body"
                                rows="3" spellcheck="false"
                                class="form-control autosize-target text-left"></textarea>
                        </div>
                    

                    <div class="form-group">
                            <label for="comment-content">Proof of work done (Url/Photos)</label>
                            <textarea placeholder="Enter url or screenshots"
                                    style="resize:vertical"
                                    id="comment-content"
                                    name="url"
                                    rows="2" spellcheck="false"
                                    class="form-control autosize-target text-left"></textarea>
                    </div>

                    
                    <div class="form-group">
                        <input type="submit" class="btn" style="background-color:darkslateblue; color:white;"
                            value="submit">
                    </div>
                </form>
            </div>
            @include('partials.comments')
    </div>

    

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
            <!--<div class="sidebar-module sidebar-module-inset">
              <h4>About</h4>
              <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>-->

            <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                    <li><a href="/projects/{{$project->id}}/edit"><i class="fas fa-edit"></i>Edit</a></li>
                    <li><a href="/projects/create"><i class="fas fa-plus-circle"></i>Create new project</a></li>
                    <li><a href="/projects"><i class="fas fa-list-ul"></i>List of projects</a></li>
                    <li><a href="/companies/{{$company->id}}"><i class="fas fa-list-ul"></i>View Company</a></li>

                    </br>

                    @if($project->user_id == Auth::user()->id)
                      <li>
                        
                        <a 
                        href="#"
                            onclick="
                            var result = confirm('Are you sure you wish to delete this project?');
                                if(result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();
                                }"
                        >
                        <i class="fas fa-trash-alt"></i>Delete
                        </a>
                        
                      <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
                        method="POST" style="display: none";>
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                      </form>

                      
                      </li>
                      @endif
                    </ol>

                    <hr/>

                    <h1>Add Members</h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <form id="add-user" action="{{ route('projects.adduser')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                <input class="form-control" name="project_id" id="project_id" value="{{ $project->id }}" type="hidden">                                    
                                    <input type="text" required class="form-control" name="email" placeholder="Email">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" id="addMember">Add!</button>
                                    </span>
                                </div>
                        </form>
                        </div>
                  </div>

                  <br/>

            <!--<div class="sidebar-module">-->
              <h4>Team Members</h4>
              <ol class="list-unstyled" id="member-list">
                  @foreach($project->users as $user)
                    <li><a href="#">{{$user->email}}</a></li>
                  @endforeach                                                   
              </ol>
            </div>
            
          </div>
 
  @endsection

{{-- using ajax --}}
  @section('jqueryScript')

          <script type="text/javascript">
                $('addMember').click(function(e){
                    e.preventDefault(); //prevent form from auto submit

                                                //   $.ajaxSetup({
                            //     headers: {
                            //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            //     }
                            // });

                            var formData = {
                                'project_id' : $('#project_id').val(),
                                'email' : $('#email').val(),
                                '_token': $('input[name=_token]').val(),
                              }
                              var url = 'projects/adduser';
                              $.ajax({
                                type: 'post',
                                url: "{{ URL::route('projects.adduser') }}",
                                data : formData,
                                dataType : 'json',
                                success : function(data){
                                      var emailField = $('#email').val();
                                    
                                    $('#member-list').prepend('<li><a href="#">'+ emailField +'</a> </li>');
                                    $('#email').val('');
                                },
                                error: function(data){
                                  //do something with data
                                  console.log("error sending ajax request" + data);
                                }
                              });
                               
                              });

                   
          </script>
  @endsection