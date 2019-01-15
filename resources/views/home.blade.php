@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-home" aria-hidden="true"></i> Dashboard <small>Statistics Overview</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</li>
    </ol>
    <!-- Statistics Area -->
    @if(Auth::user()->role=='admin'||Auth::user()->role=='super')
        <div class="row tag-boxes">

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$students_count}}</div>
                                <div class="text-right">Students</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.students') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Students</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user-md fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$specialists_count}}</div>
                                <div class="text-right">Subject Specialists</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.specialists') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Sub. Specialists</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-paw fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$supervisors_count}}</div>
                                <div class="text-right">Subject Supervisors</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.supervisors') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Sub. Supervisors</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$users_count}}</div>
                                <div class="text-right">All Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Users</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$subjects_count}}</div>
                                <div class="text-right">Subjects</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('subjects') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Subjects</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-puzzle-piece fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$sections_count}}</div>
                                <div class="text-right">Sections</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('sections.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View All Sections</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-window-restore fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$subsections_count}}</div>
                                <div class="text-right">Subsections</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('subsections.index') }}" class="text-success">
                        <div class="panel-footer">
                            <span class="pull-left">View All Subsections</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-question fa-3x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9">
                                <div class="text-right huge">{{$questions_count}}</div>
                                <div class="text-right">Questions</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('questions.index') }}" class="text-success">
                        <div class="panel-footer">
                            <span class="pull-left">View All Questions</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection