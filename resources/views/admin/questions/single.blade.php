@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div style="margin-top: 0;" class="h3 panel-heading">
            Priority : {{ $question->priority }}
            <span class="pull-right">
                {{$question->current_age}}/{{$question->maximum_age}}
            </span>
        </div>
        <div class="panel-body">
            <div class="container">
                @if($question->pre_image!='0' && $question->post_image!='0')
                    <div style="margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="h3">Pre-Image:</div>
                            <img style="height: 150px; width: 200px" src="{{asset($question->pre_image)}}">
                        </div>
                        <div class="col-md-6">
                            <div class="h3">Post-Image:</div>
                            <img style="height: 150px; width: 200px" src="{{asset($question->post_image)}}">
                        </div>
                    </div>
                </div>
                @endif
                <div style="margin-bottom: 20px;">
                    <div class="h3">Question Statement:</div>
                    <div class="p" style="padding-left: 50px;">{{$question->statement}}</div>
                </div>
                <div class="from-group"  style="margin-bottom: 20px;">
                    <div class="h3">Options:</div>
                    <ol style="list-style-type: lower-alpha">
                        @foreach($question->options as $option)
                            <li class="form-group" style="margin-right: 100px;">
                                <label class="col-md-3" style="margin-left: 50px;margin-right: 100px;">{{$option->option}}</label>
                                @if($question->user_id==Auth::user()->id || Auth::user()->role=='supervisor')
                                    <div class="col-md-3">
                                        @if($option->key==0)
                                            <a href="{{route('question.assign.key',['oid'=>$option->id,'qid'=>$question->id])}}" @if(Auth::user()->role=='supervisor') style="display: none;" @endif class="btn btn-primary">Make Key</a>
                                        @else
                                            <div style="margin-top: 7px;" class="text-success"><i class="fas fa-check"></i> Selected</div>
                                        @endif
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div style="margin-bottom: 20px;">
                    <span class="h3">Subsection:</span>
                    <span class="p" style="padding-left: 50px;">{{$question->subsection->name}}</span>
                </div>
                <div style="margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="h3">Composed By:</span>
                            <span class="p" style="padding-left: 50px;">
                                @foreach($question->users as $user)
                                    @if($user->role=='specialist')
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="h3">Composed Date:</span>
                        <span class="p" style="padding-left: 50px;">
                            {{$question->user_time}}
                        </span>
                        </div>
                    </div>
                </div>
                @if($question->supervisor_id!='0')
                        <div style="margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="h3">Approved By:</span>
                        <span class="p" style="padding-left: 50px;">
                            @foreach($question->users as $user)
                                @if($user->role=='supervisor')
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="h3">Approved Date:</span>
                        <span class="p" style="padding-left: 50px;">
                            {{$question->supervisor_time}}
                        </span>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
@stop