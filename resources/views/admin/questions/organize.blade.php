@extends('layouts.app')

@section('content')
    <div class="text-right">
        @if($status=='1')
            <form action="{{route('questions.organizeFilter')}}" method="post">
                {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="filter">View by subsection:</label>
                    <div class="col-sm-7">
                        <select class="form-control" id="filter" name="filter">
                            <option selected>Choose...</option>
                            @foreach($subsections as $subsection)
                                <option value="{{$subsection->id}}">{{$subsection->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="btn btn-primary col-sm-2" type="submit" value="Filter">
                </div>
            </form>
        @endif
    </div>
    <ul style="border-radius: 0" class="list-group">
        <li style="border-radius: 0" class="list-group-item">
            <div class="h4">No. of Questions added for Each Subsection</div>
        </li>
        @foreach($subsections as $subsection)
            <li style="border-radius: 0" class="list-group-item">
                {{$subsection->name}} : {{$counts[$subsection->name]}}
            </li>
        @endforeach
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover" id="table_id">
                <thead>
                <th>Priority#</th>
                <th>Question Statement</th>
                <th>Options</th>
                <th>Composed By</th>
                <th>Approved By</th>
                <th>Organizing</th>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{$question->priority}}</td>
                        <td>{{$question->statement}}</td>
                        <td>
                            <ul style="list-style-type: lower-alpha">
                                @foreach($question->options as $option)
                                    <li>{{$option->option}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            @foreach($question->users as $user)
                                @if($user->role != 'supervisor')
                                    <div><img src="{{asset($user->profile->avatar)}}" style="border-radius: 50%;height: 50px;width: 50px;"></div>
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </td>
                        @if($status=='0')
                            <td><a class="btn btn-primary" href="{{route('questions.approve',['id'=>$question->id])}}">Approve</a></td>
                        @else
                            <td>
                                @foreach($question->users as $user)
                                    @if($user->role == 'supervisor')
                                        <div><img src="{{asset($user->profile->avatar)}}" style="border-radius: 50%;height: 50px;width: 50px;"></div>
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td class="text-center">
                            @if(!count($question->sets)>0)
                                <a class="btn btn-primary" style="display: none; @foreach($question->options as $option) @if($option->key==1) display:block @endif @endforeach"  href="{{route('questions.organize',['id'=>$question->id])}}">Add to Test</a>
                                <div style="cursor: no-drop;@foreach($question->options as $option) @if($option->key==1) display:none @endif @endforeach" class="text-center text-danger"><div style="font-size: 25px;"><i style="padding-right: 10px;" class="fas fa-times"></i></div>Not available</div>
                            @else
                                @foreach($question->sets as $set)
                                    @if($set->name==Auth::user()->set)
                                        <a class="btn btn-danger" href="{{route('questions.organize.undo',['q_id'=>$question->id])}}">Undo</a>
                                    @else
                                        <div style="cursor: no-drop" class="text-center text-danger"><div style="font-size: 25px;"><i style="padding-right: 10px;" class="fas fa-times"></i></div>Not available</div>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group text-right">
        <a href="{{route('tests.generated',['set' => Auth::user()->set])}}" class="btn btn-primary">Done Organizing</a>
    </div>
@stop