@extends('layouts.app')
@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    {{-- @if($companies -> check()) --}}
    <div class="panel panel-default">
        <div class="panel-heading">Companies<a class="pull-right btn btn-default btn-sm" style="color:black" href="/companies/create">Create new</a>
        </div>
        <div class='panel-body'>
            @if ($companies->isEmpty())
                <h1>NO COMPANY CREATED</h1></br>
            @else
                <ul class="list-group">
                    @foreach($companies as $company)
                        <li class="list-group-item"><a href="/companies/{{$company->id}}">{{$company->name}}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>        
    
</div>

@endsection


