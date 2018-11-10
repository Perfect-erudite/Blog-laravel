@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
                <span><b>ABOUT US</b></span>

                <div
                 style="color: black;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <b>WELCOME! {{ Auth::user()->name }}</b> <b class="pull-right">YOU ARE LOGGED IN</b>
        </div>

    </div> 
</div>
<img src="{{asset('image/Braintemple.jpg')}}" style="width:20%; height:40%; margin-left:10%; float:left;">   
<div class="content">
        <p style="font-size: 300%; color:black;"> <b>Braintemple Software Academy </b></p>
        <article style="color:black; font-size: 150%; margin-right: 20%">The project manager is designed in other to help in the management of record of every project and tasks created at Braintemple.
            It also helps in checking out the task proress and users assigned to a project and users assigned to a task or more.
        </article>
    </div>
</div>
@endsection
