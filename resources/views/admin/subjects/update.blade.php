@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-book" aria-hidden="true"></i> Subjects <small>All Subjects</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-book" aria-hidden="true"></i> Subjects / <i class="fa fa-edit" aria-hidden="true"></i> Edit</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Editing subject : {{$subject->name}}
        </div>
        <div class="panel-body">
            <form action="{{route('subject.update',['id'=>$subject->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Subject Name</label>
                    <input class="form-control" type="text" value='{{$subject->name}}' name="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Update subject</button>
                </div>
            </form>
        </div>
    </div>
@stop