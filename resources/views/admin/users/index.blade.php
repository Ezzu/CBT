@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-users" aria-hidden="true"></i> Users <small>All Users</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-users" aria-hidden="true"></i> Users</li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i> List
            <a href="{{ route('user.create') }}" class="btn btn-success" style="position: relative; left: calc(100% - 18%);">Add New User</a>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover" id="table_id">
                        <thead>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                @if($users->count()>0)
                                    <td><img style="border-radius:50%;height:50px;width:50px;" src="{{asset($user->profile->avatar)}}"></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        @if($user->role!='student')
                                            @if($user->test_grant==1)
                                                <a class="btn btn-xs btn-danger" href="{{route('user.ungrant',['id'=>$user->id])}}">Remove Priviliages</a>
                                            @else
                                                @if($set_count < 3)
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-xs btn-primary">Grant Test</button>
                                                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            @if($sets['a']==0)
                                                                <li><a href="{{route('user.grant',['id'=>$user->id,'set'=>'A'])}}">Set A</a></li>
                                                            @endif
                                                            @if($sets['b']==0)
                                                                <li><a href="{{route('user.grant',['id'=>$user->id,'set'=>'B'])}}">Set B</a></li>
                                                            @endif
                                                            @if($sets['c']==0)
                                                                <li><a href="{{route('user.grant',['id'=>$user->id,'set'=>'C'])}}">Set C</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="text-primary">All sets are assigned</div>
                                                @endif
                                            @endif
                                        @else
                                            <span class="btn-success btn btn-xs text-danger">No rights available</span>
                                        @endif
                                    <a class="btn btn-xs btn-danger" href="{{route('user.delete',['id'=>$user->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                @else
                                    <td class="h1 text-center" colspan="4">No users to show</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop