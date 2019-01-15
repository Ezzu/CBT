@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-users" aria-hidden="true"></i> Users <small>All Users</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-users" aria-hidden="true"></i> Users / <i class="fa fa-plus" aria-hidden="true"></i> New</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Add new user
        </div>
        <div class="panel-body">
            <form action="{{route('user.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option selected>Choose...</option>
                        <option value="admin">Admin</option>
                        <option value="specialist">Subject Specialist</option>
                        <option value="supervisor">Subject Supervisor</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Add user</button>
                </div>
            </form>
        </div>
    </div>
@stop