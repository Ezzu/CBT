@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-book" aria-hidden="true"></i> Subjects <small>All Subjects</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-book" aria-hidden="true"></i> Subjects</li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i> List
            <a href="{{ route('subject.create') }}" class="btn btn-success" style="position: relative; left: calc(100% - 20%);">Add New Subject</a>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover" id="table_id">
                        <thead>
                        <th>Subject Name</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{$subject->name}}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{route('subject.edit',['id'=>$subject->id])}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <a class="btn btn-xs btn-danger ml-1" href="{{route('subject.delete',['id'=>$subject->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop