@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-plus-square" aria-hidden="true"></i> Sub-sections <small>All Sub-sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-plus-square" aria-hidden="true"></i> Sub-sections / <i class="fa fa-plus" aria-hidden="true"></i> Add</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Add new subsection
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach($sections as $section)
                    <div class="col-lg-6">Questions left for {{$section->subject->name}} : {{$counts[$section->name]}}</div>
                @endforeach
            </div>
            <hr>
            <form action="{{route('subsections.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Subsection Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="subject">Section</label>
                    <select class="form-control" id="section" name="section">
                        <option selected>Choose...</option>
                        @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_questions">Number of questions</label>
                    <input class="form-control" type="number" name="number_of_questions">
                </div>
                <div class="form-group">
                    <label for="sequence_number">Sequence Number</label>
                    <select class="form-control" id="sequence_number" name="sequence_number">
                        <option selected>Choose...</option>
                        @for($i=1;$i<=15;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Add subsection</button>
                </div>
            </form>
        </div>
    </div>
@stop