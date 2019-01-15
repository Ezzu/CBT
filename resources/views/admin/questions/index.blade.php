@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-question" aria-hidden="true"></i> Questions <small>All Questions</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-question" aria-hidden="true"></i> Questions</li>
    </ol>
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-list" aria-hidden="true"></i> List
            @if(Auth::user()->role == 'specialist')
                <a href="{{ route('questions.create') }}" class="btn btn-success" style="position: relative; left: calc(100% - 20%);">Add New Question</a>
            @endif
        </div>
        <div class="panel-body">
            <div class="text-right">
                @if($status=='1')
                    <form action="{{route('questions.filter')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="filter">View by subsection:</label>
                            <div class="col-sm-6">
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover" id="table_id_scroll">
                        <thead>
                        <th>Priority#</th>
                        <th>Question Statement</th>
                        <th>Options</th>
                        <th>Subsection</th>
                        <th>Difficulty Level</th>
                        <th>Age</th>
                        <th>Max. Age</th>
                        <!--       <th>Key</th> -->
                        <th>Composed By</th>
                        @if($status=='0')
                            <th>Approve</th>
                        @else
                            <th>Approved By</th>
                        @endif
                        <th>Actions</th>
                        {{--@if((Auth::user()->role=='specialist' && $status==0)||(Auth::user()->role=='supervisor'||Auth::user()->role=='admin'||Auth::user()->role=='super'))--}}
                            {{--<th>Trash</th>--}}
                        {{--@endif--}}
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
                                <!--                    <td>
                            @foreach($question->options as $option)
                                @if($option->key==1)
                                {{$option->option}}
                                @endif
                                @endforeach
                                        </td>  -->
                                <td>
                                    {{$question->subsection->name}}
                                </td>
                                <td>
                                    {{$question->difficulty_level}}
                                </td>
                                <td>
                                    {{$question->current_age}}
                                </td>
                                <td>
                                    {{$question->maximum_age}}
                                </td>
                                <td class="text-center">
                                    @foreach($question->users as $user)
                                        @if($user->role == 'specialist')
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
                                <td>
                                    @if($question->user_id <> Auth::user()->id && Auth::user()->role<>'supervisor')
                                        <a class="btn btn-xs btn-info" href="{{route('questions.show',['id'=>$question->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @else
                                        <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#exampleModal{{$question->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <div class="text-center small text-danger" @foreach($question->options as $option) @if($option->key==1) style="display:none" @endif @endforeach>Key not assigned</div>
                                        <a href="{{route('questions.show',['id'=>$question->id])}}" id="{{$question->id}}"></a>
                                        <div class="modal fade" id="exampleModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Authentication Required</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="password">Security Keyword:</label>
                                                            <input type="hidden" value="{{Auth::user()->profile->security_answer}}" class="keywordh{{$question->id}}">
                                                            <input type="password" class="form-control keyword{{$question->id}}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary verify" value="{{$question->id}}">Verify</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--@if((Auth::user()->role=='specialist' && $status==0)||(Auth::user()->role=='supervisor'||Auth::user()->role=='admin'||Auth::user()->role=='super'))--}}
                                        <form action="{{route('questions.destroy',['id'=>$question->id])}}" method="post">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-xs btn-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    {{--@endif--}}
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

@section('js_script')
    <script>
        $(document).ready( function () {
            $('#table_id_scroll').DataTable({
                "scrollX": true,

            });
        } );
        $('.verify').on('click',function(){
            if($('.keywordh'+$(this).val()).val()==$('.keyword'+$(this).val()).val()){
                document.getElementById($(this).val()).click();
            }
            else {
                document.getElementById('close').click();
                toastr.warning("Authentication restricted");
            }
        });
    </script>
@stop