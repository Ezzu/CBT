@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-question" aria-hidden="true"></i> Questions <small>All Questions</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-question" aria-hidden="true"></i> Questions / <i class="fa fa-plus" aria-hidden="true"></i> New</li>
    </ol>
    @include('admin.includes.errors')
    @include('admin.includes.clearcookies')
    <div class="panel panel-default">
        <div class="panel-heading">
            Add new question
        </div>
        <div class="panel-body">
            <form action="{{route('questions.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pre_image">Pre-Image</label>
                        <input type="file" class="form-control" name="pre_image" name="pre_image">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="post_image">Post-Image</label>
                        <input type="file" class="form-control" id="post_image" name="post_image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Question</label>
                    <textarea class="form-control" name="statement" id="statement" cols="6" rows="6"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="optiona">Option A</label>
                        <input type="text" class="form-control" name="optiona">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="optionb">Option B</label>
                        <input type="text" class="form-control" name="optionb">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="optionc">Option C</label>
                        <input type="text" class="form-control" name="optionc">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="optiond">Option D</label>
                        <input type="text" class="form-control" name="optiond">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subsection_id">Subsection</label>
                    <select class="form-control" id="subsection_id" name="subsection_id">
                        <option selected>Choose...</option>
                        @foreach($subsections as $subsection)
                            <option value="{{$subsection->id}}">{{$subsection->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="difficulty_level">Difficulty Level</label>
                    <select class="form-control" id="difficulty_level" name="difficulty_level">
                        <option selected>Choose...</option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="difficult">Difficult</option>
                        <option value="tough">Tough</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="maximum_age">Maximum age</label>
                    <input class="form-control" type="number" name="maximum_age">
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="current_age">Current age</label>--}}
                    {{--<input class="form-control" type="number" name="current_age">--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select class="form-control" id="priority" name="priority">
                        <option selected>Choose...</option>
                        @for($i=1;$i<=100;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="success_ratio">Success Ratio</label>--}}
                    {{--<input class="form-control" type="number" name="success_ratio">--}}
                {{--</div>--}}
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Add question</button>
                </div>
            </form>
        </div>
    </div>
@stop