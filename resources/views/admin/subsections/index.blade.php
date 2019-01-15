@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-plus-square" aria-hidden="true"></i> Sub Sections <small>All Sub-sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-plus-square" aria-hidden="true"></i> Sub-sections</li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i> List
            <a href="{{ route('subsections.create') }}" class="btn btn-success" style="position: relative; left: calc(100% - 23%);">Add New Sub-section</a>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover" id="table_id">
                        <thead>
                        <th>Sequence#</th>
                        <th>Subsection</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>No of Questions</th>
                        <th>Editing</th>
                        <th>Deleting</th>
                        </thead>
                        <tbody>
                        @foreach($subsections as $subsection)
                            <tr>
                                <td>{{$subsection->sequence_number}}</td>
                                <td>{{$subsection->name}}</td>
                                <td>{{$subsection->section->name}}</td>
                                <td>{{$subsection->section->subject->name}}</td>
                                <td>{{$subsection->number_of_questions}}</td>
                                <td><a class="btn btn-xs btn-primary" href="{{route('subsections.edit',['id'=>$subsection->id])}}">Edit</a></td>
                                <td>
                                    <form action="{{route('subsections.destroy',['id'=>$subsection->id])}}" method="post">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button class="btn btn-xs btn-danger">Delete</button>
                                    </form>
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