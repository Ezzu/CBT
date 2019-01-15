<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CBT Engine</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png">

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">

    <!-- Animated -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Bootstrap -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

    @yield('styles')

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <style>
        body{
            padding-top: 0;
        }
        .navbar{
            background: rgb(10,111,180);
        }
        .navbar-default .navbar-brand,.navbar-default .navbar-nav>li>a, .navbar-default .navbar-text{
            color: white;
        }
        .navbar-default .navbar-brand:hover,.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-text:hover{
            background: rgb(10,121,230);
            color: white;
        }
        .list-group-item.active{
            color: #fff;
            background-color: rgb(10,111,180);
            border-color: rgb(10,111,180);
        }
        .panel-default>.panel-heading{
            background: rgb(10,111,180);
            color: #fff;
        }
    </style>
</head>
<body>
    
    <div id="app">
        <!--Navbar-->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Department of CS GCU</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @auth
                            @if(Auth::user()->role=='specialist')
                                <li><a href="{{route('questions.create')}}"><i class="fa fa-question" aria-hidden="true"></i> Add Question</a></li>
                            @endif
                            @if(Auth::user()->role=='super'||Auth::user()->role=='admin')
                                <li><a href="{{route('subsections.create')}}"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Subsection</a></li>
                                <li><a href="{{route('sections.create')}}"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Add Section</a></li>
                                <li><a href="{{route('subject.create')}}"><i class="fa fa-book" aria-hidden="true"></i> Add Subject</a></li>
                                <li><a href="{{route('user.create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Add User</a></li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="padding:10px;" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span><img style="border-radius:50%;height:30px;width:30px;" src="{{asset(Auth::user()->profile->avatar)}}"></span><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="">
                                            {{Auth::user()->email}}
                                        </a>
                                    </li>
                                    <li><a href="{{route('profile.edit')}}">Account Settings</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{route('login')}}"><i class="fa fa-share-square" aria-hidden="true"></i> Login</a></li>
                        @endif
                    </ul>

                </div>
            </div>
        </nav>

        <div style="margin: 30px;">
            <div class="row">
                @if(Auth::check())
                    <div class="col-lg-3">
                        <ul class="list-group">
                            <a href="{{route('home')}}" class="list-group-item active">
                                <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                            </a>
                            @if(Auth::user()->role=='super'||Auth::user()->role=='admin')
                                <a href="{{route('users')}}" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
                                <a href="{{route('subjects')}}" class="list-group-item"><i class="fa fa-book" aria-hidden="true"></i> Subjects</a>
                                <a href="{{route('sections.index')}}" class="list-group-item"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections</a>
                                <a href="{{route('subsections.index')}}" class="list-group-item"><i class="fa fa-window-restore" aria-hidden="true"></i> Subsections</a>
                            @endif
                            @if(Auth::user()->role=='supervisor')
                                <a href="{{route('questions.toApprove')}}" class="list-group-item"><i class="fa fa-paw" aria-hidden="true"></i> Approve Questions</a>
                            @endif
                            @if(Auth::user()->role == 'specialist' || Auth::user()->role == 'admin')
                                <a href="{{route('questions.index')}}" class="list-group-item"><i class="fa fa-question" aria-hidden="true"></i> Questions</a>
                            @endif
                            @if(Auth::user()->role=='super'||Auth::user()->role=='admin')
                                <a href="{{route('subsections.index')}}" class="list-group-item"><i class="fa fa-trash" aria-hidden="true"></i> Trashed questions</a>
                            @endif
                            @if(Auth::user()->test_grant==1 && count(Auth::user()->activities()->find(12))==0)
                                <a href="{{route('questions.toOrganize')}}" class="list-group-item"><i class="fa fa-paperclip" aria-hidden="true"></i> Organize Test Set {{Auth::user()->set}}</a>
                                <a href="{{route('tests.view',['mode'=>1])}}" target="_blank" class="list-group-item"><i class="fa fa-eye" aria-hidden="true"></i> View Test Set {{Auth::user()->set}}</a>
                            @endif
                            @if(Auth::user()->role=='student')
                                @foreach(Auth::user()->activities as $activity)
                                    @if($activity->name=='Test Ended')
                                        <a href="{{route('tests.result')}}" class="list-group-item"><i class="fa fa-balance-scale" aria-hidden="true"></i> Result</a>
                                    @elseif($activity->name=='Has Token')
                                        <a href="{{route('tests.view',['mode'=>0])}}" class="list-group-item"><i class="fa fa-play" aria-hidden="true"></i> Start Test</a>
                                    @endif
                                @endforeach
                            @endif
                            @if(Auth::user()->role=='super')
                                <a href="{{ route('test.settings') }}" class="list-group-item"><i class="fa fa-cogs" aria-hidden="true"></i> Test Settings</a>
                            @endif
                        </ul>
                    </div>
                @endif
                <div class="col-lg-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/check_boxes.js')}}"></script>
    <!-- Ajax -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        $('.btn-danger').on('click', function(){
           return confirm('Are you sure you want to perform this action ?');
        });
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}");
        @endif
        @if(Session::has('failure'))
        toastr.error("{{Session::get('failure')}}");
        @endif
        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}");
        @endif
    </script>
    @yield('js_script')
</body>
</html>
