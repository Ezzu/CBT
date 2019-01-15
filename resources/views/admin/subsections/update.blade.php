@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-plus-square" aria-hidden="true"></i> Sub-sections <small>All Sub-sections</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-plus-square" aria-hidden="true"></i> Sub-sections / <i class="fa fa-edit" aria-hidden="true"></i> Edit</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Editing Sub-section : {{ $subsection->name }}
        </div>
        <div class="panel-body">
            <form action="{{route('subsections.update',['id'=>$subsection->id])}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Subsection Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $subsection->name }}">
                </div>
                <div class="form-group">
                    <label for="subject">Section</label>
                    <select class="form-control" id="section" name="section">
                        <option selected>Choose...</option>
                        @foreach($sections as $section)
                            <option value="{{$section->id}}" @if($section->id == $subsection->section_id) selected @endif>{{$section->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_questions">Number of questions</label>
                    <input class="form-control" type="number" name="number_of_questions" value="{{ $subsection->number_of_questions }}">
                </div>
                <div class="form-group">
                    <label for="sequence_number">Sequence Number</label>
                    <select class="form-control" id="sequence_number" name="sequence_number" value="{{ $subsection->sequence_number }}">
                        <option selected>Choose...</option>
                        @for($i=1;$i<=15;$i++)
                            <option value="{{$i}}" @if($subsection->sequence_number == $i) selected @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Update Sub-section</button>
                </div>
            </form>
        </div>
    </div>
@stop