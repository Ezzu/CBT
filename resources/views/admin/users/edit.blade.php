@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-cog" aria-hidden="true"></i> Settings <small>Account Settings</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-cog" aria-hidden="true"></i> Settings</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Account Settings
        </div>
        <div class="panel-body">
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea class="form-control" name="about" id="about" cols="6" rows="6"></textarea>
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook" name="facebook">Facebook</label>
                    <input class="form-control" type="url" name="facebook">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Update account settings</button>
                </div>
            </form>
        </div>
    </div>
@stop