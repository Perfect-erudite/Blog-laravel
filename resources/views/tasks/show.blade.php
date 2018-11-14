@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <!-- The justified navigation menu is meant for single line per list item.
            Multiple lines will require custom code not provided by Bootstrap. -->
    

        <!-- Jumbotron -->
        <div class="well well-lg">
            {{-- Displays the name of the task --}}
            <h1>{{ $task->name }}</h1>
        </div> 

        <!-- Example row of columns -->
        <div class="row" style="background-color:white; margin:10px">
                {{-- <a href="/projects/create" class="pull-right btn btn-primary btn-sm">Add project</a> --}}
                <br/>


            <div class="row container-fluid">
                <form method="post" action="{{ route('comments.store') }}">
                    {{ csrf_field() }}

                            <input type="hidden" name="commentable_type" value="App\Task"/>
                            <input type="hidden" name="commentable_id" value="{{$task->id}}"/>
                            
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
                        <input type="submit" class="btn btn-primary"
                            value="submit">
                    </div>
                </form>
            </div>
            @include('partials.comments')
        </div>
    </div>

    

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">

            <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                    <li><a href="/tasks/{{$task->id}}/edit"><i class="fas fa-edit"></i>Edit</a></li>
                    <li><a href="/tasks/create"><i class="fas fa-plus-circle"></i>Create new task</a></li>
                    <li><a href="/tasks"><i class="fas fa-list-ul"></i>List of tasks</a></li>

                    </br>

                    {{-- @if($task->user_id == Auth::user()->id ) --}}
                      <li>
                        
                        <a 
                        href="#"
                            onclick="
                            var result = confirm('Are you sure you wish to delete this task?');
                                if(result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();
                                }"
                        >
                        <i class="fas fa-trash-alt"></i>Delete
                        </a>
                        
                      <form id="delete-form" action="{{ route('tasks.destroy',[$task->id]) }}"
                        method="POST" style="display: none";>
                          <input type="hidden" name="_method" value="delete">
                          {{ csrf_field() }}
                      </form>

                      
                      </li>
                      {{-- @endif --}}
                    </ol>

                    <hr/>

                    <h1>Add Members</h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <form id="add-user" action="{{ route('tasks.adduser')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                <input class="form-control" name="task_id" id="task_id" value="{{ $task->id }}" type="hidden">                                    
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
                  @foreach($task->users as $user)
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
                                'task_id' : $('#task_id').val(),
                                'email' : $('#email').val(),
                                '_token': $('input[name=_token]').val(),
                              }
                              var url = 'tasks/adduser';
                              $.ajax({
                                type: 'post',
                                url: "{{ URL::route('tasks.adduser') }}",
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