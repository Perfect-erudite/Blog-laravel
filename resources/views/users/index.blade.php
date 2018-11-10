 @extends('layouts.app')
 @section('content')
 <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">All Users</div>
            
                <!-- Table -->
                
                <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email </th>
                    <th>Action </th>
                </tr>
                <tr>
                    @foreach($users as $user)
                    <td>{{$user->name}}</td>
                    
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="/users/{{$user->id}}">View</a>
                    </td>
                    {{-- <form id="delete-form" action="{{ route('users.destroy',[$user->id]) }}"
                            method="POST" style="display: none";>
                              <input type="hidden" name="_method" value="delete">
                              {{ csrf_field() }}
                          </form>                     --}}
                    
                </tr>
                @endforeach
                </table>
            </div>
                
@endsection