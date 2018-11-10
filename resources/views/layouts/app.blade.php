<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Braintemple Project Manager') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style>
        .panel > .panel-heading{
            background-color: grey;
            color: white;
        }
        .fas{
            color:white;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color: grey;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        <span style="color:white;">Project Manager</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><span style="color:white;">Login</span></a></li>
                            <li><a href="{{ route('register') }}"><span style="color:white;"> Register </span></a></li>
                        @else

                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i><span style="color:white;"> Home</span></a></li> 

                        @if(Auth::user()->role_id < 3)    {{--If an admin or moderator --}}                                         
                        <li><a href="{{ route('companies.index') }}"><i class="fas fa-building"></i><span style="color:white;">All Companies</span></a></li>
                        @else
                        <li><a href="{{ route('companies.index') }}"><i class="fas fa-building"></i><span style="color:white;"> Companies</span></a></li>
                        @endif
                        
                        @if(Auth::user()->role_id < 3)  {{--If an admin or moderator --}} 
                        <li><a href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i><span style="color:white;">All Projects</span></a></li>
                        @else
                        <li><a href="{{ route('projects.index') }}"><i class="fas fa-project-diagram"></i><span style="color:white;"> Projects</span></a></li>
                        @endif
                        
                        
                        @if(Auth::user()->role_id < 3)  {{--If an admin or moderator --}} 
                        <li><a href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i><span style="color:white;">All Tasks</span></a></li>
                        @else
                        <li><a href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i><span style="color:white;"> Tasks</span></a></li>
                        @endif                        
                        

                        @if(Auth::user()->role_id == 1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-unlock-alt"></i><span style="color:white;">Admin</span><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('users.index') }}"><i class="fas fa-user"></i> All Users</a></li>
                                    <li><a href="{{ route('roles.index') }}"><i class="fas fa-briefcase"></i> All Roles</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(Auth::user()->role_id == 2)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-unlock-alt"></i><span style="color:white;">Moderator</span><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('users.index') }}"><i class="fas fa-user"></i> All Users</a></li>
                                    {{-- <li><a href="{{ route('roles.index') }}"><i class="fas fa-briefcase"></i> All Roles</a></li> --}}
                                </ul>
                            </li>
                        @endif
                            <li>
                                <a href="/users/{{Auth::user()->id}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-user"></i>
                                    <span style="color:white;">{{ Auth::user()->name }}</span> <span class="caret"></span>
                                </a>
                                {{-- <a href="/users/{{Auth::user()->id}}"><i class="fas fa-user"></i>
                                    <span style="color:white;">{{ Auth::user()->name }}</span>
                                </a> --}}

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/users/{{Auth::user()->id}}">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @include('partials.errors')
            @include('partials.success')
            <div class="row">
                @yield('content')
            </div>
        </div>
           <!-- Main Footer -->
    </div>
    <footer class="main-footer" style="max-height: 100px;text-align: center">
        <strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('jqueryScript')
</body>
</html>
