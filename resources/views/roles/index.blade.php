@extends('layouts.app')
@section('content')

    {{-- <ul>
        @foreach($roles as $role)
            <li>{{$role->name}}</li>
        @endforeach
    </ul> --}}

    <table class="table table-responsive" id="roles-table">
            <thead>
                <tr>
                    <th>Name</th>
                    {{-- <th colspan="3">Action</th> --}}
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{!! $role->name !!}</td>
                    {{-- <td>
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                            <a href="{!! route('roles.show', [$role->id]) !!}">List Of Admin</a>
                            <a href="{!! route('roles.edit', [$role->id]) !!}">List of Moderators</a>
                            <a href="{!! route('roles.edit', [$role->id]) !!}">List of Users</a>                            
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
        </table>


@endsection