@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections <small>All Sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections</li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i> List
            <a href="{{ route('sections.create') }}" class="btn btn-success" style="position: relative; left: calc(100% - 20%);">Add New Section</a>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover" id="table_id">
                        <thead>
                        <th>Section Name</th>
                        <th>Subject Name</th>
                        <th>No of Questions</th>
                        <th>Editing</th>
                        <th>Deleting</th>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{$section->name}}</td>
                                <td>{{$section->subject->name}}</td>
                                <td>{{$section->number_of_questions}}</td>
                                <td><a class="btn btn-xs btn-primary" href="{{route('sections.edit',['id'=>$section->id])}}">Edit</a></td>
                                <td>
                                    <form action="{{route('sections.destroy',['id'=>$section->id])}}" method="post">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-xs btn-danger" href="">Delete</button>
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