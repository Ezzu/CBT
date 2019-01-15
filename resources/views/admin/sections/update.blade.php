@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections <small>All Sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Sections / <i class="fa fa-edit" aria-hidden="true"></i> Edit</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Editing subject : {{$section->name}}
        </div>
        <div class="panel-body">
            <form action="{{route('sections.update',['id'=>$section->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Section Name</label>
                    <input class="form-control" value="{{$section->name}}" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject">
                        <option>Choose...</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->subject_id}}"
                                    @if($section->subject->subject_id == $subject->subject_id)
                                        selected
                                    @endif>{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Add subject</button>
                </div>
            </form>
        </div>
    </div>
@stop