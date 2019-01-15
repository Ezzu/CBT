@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections <small>All Sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections / <i class="fa fa-plus" aria-hidden="true"></i> Add</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Add new section
        </div>
        <div class="panel-body">
            <form action="{{route('sections.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Section Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject">
                        <option selected>Choose...</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_questions">Number of questions</label>
                    <input class="form-control" type="number" name="number_of_questions">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Add section</button>
                </div>
            </form>
        </div>
    </div>
@stop