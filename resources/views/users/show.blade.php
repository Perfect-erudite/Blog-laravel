 @extends('layouts.app')
 @section('content')
 {{-- <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">{{$user->name}}</div>
            
                <!-- Table -->
                <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email </th>
                </tr>
                </table>
            </div> --}}
            {{-- <div class="widget-user-image" style="float:left;">
                <img class="img-circle" src="{{ asset('image/Ayo.jpg')}}" alt="{{$user->name}}" style="width:30%;">
                <form class="container" action='{{ route('users.update') }}' method='POST'>
                    {{csrf_field()}}
                      Input a picture
                      <input type="file" name="picture">
                      <!-- <input class="user_input" type="password" name="name" placeholder="Confirm password"><br><br><br><br>                 -->
                      <input type="submit" name="submit" value="Upload" class="login-btn" >
                </form>
            </div> --}}
            

{{-- <div class="col-md-4">
        <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">{{$user->name}}</h3>
                <h5 class="widget-user-desc">{{$user->email}}</h5>
                </div> --}}
                
                {{-- <div class="box-footer">
                        <div class="row">
                                <div class="col-sm-6 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header">Gender</h5>
                                    <span class="description-text">Female</span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header">Role</h5> --}}
                                    {{-- <span class="description-text">{!! $user->role['name'] !!}</span> --}}
                                  {{-- </div>
                                  <!-- /.description-block -->
                                </div>
                              </div>
        
        
        
                        <div class="box-footer no-padding">
                                <ul class="nav nav-stacked"> --}}
                                  {{-- <li><a href="www.facebook.com">Facebook Profile<span class="pull-right">View</span></a></li> --}}
                                {{-- <li>Joined <span class="pull-right">{!! $user->created_at->format('D, M, Y') !!}</span></li>
                                </ul>
                              </div>          
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
            </div> --}}





            <div class="container">
              <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    @if($user->avatar)
                      <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                    @else
                    <img src ="/uploads/avatars/user.jpg" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                    @endif
                      <h2>{{ $user->name }}'s Profile</h2>
                      <form enctype="multipart/form-data" action="{{ route('users.update') }}" method="POST">
                          <label>Update Profile Image</label>
                          <input type="file" name="avatar">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" class="pull-right btn btn-sm btn-primary">
                      </form>
                  </div>
              </div>
          </div>
        
        
        
        
        
@endsection