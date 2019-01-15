@extends('layouts.app')

@section('content')
    <h1><i class="fa fa-cog" aria-hidden="true"></i> Settings <small>Test Settings</small></h1><hr>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Dashboard / <i class="fa fa-cog" aria-hidden="true"></i> Test Settings</li>
    </ol>
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading">
            Test Settings
        </div>
        @if($set_count==3 && $all_set)
            <div class="panel-body">
                <div class="form-group row">
                    <label class="col-lg-3">Choose Test Set :</label>
                    <div class="col-lg-3"><a href="{{route('tests.set',['set'=>1])}}" class="btn btn-info" @foreach($users as $user) @if($user->activities->find(14)) disabled @endif @endforeach>Test Set A
                            @if($selected=='1')
                                <i class="ml-5 fa fa-check" aria-hidden="true"></i>
                            @endif
                        </a></div>
                    <div class="col-lg-3"><a href="{{route('tests.set',['set'=>2])}}" class="btn btn-info" @foreach($users as $user) @if($user->activities->find(14)) disabled @endif @endforeach>Test Set B
                            @if($selected=='2')
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @endif
                        </a></div>
                    <div class="col-lg-3"><a href="{{route('tests.set',['set'=>3])}}" class="btn btn-info" @foreach($users as $user) @if($user->activities->find(14)) disabled @endif @endforeach>Test Set C
                            @if($selected=='3')
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @endif
                        </a></div>
                </div>
                @if(count($selected)!=0)
                    <form action="{{route('users.tokenize')}}" method="post">
                        {{csrf_field()}}
                        <div class="text-center">
                            <input type="submit" id="tokens" type="submit" class="btn btn-success" value="Generate Token for Every Student">
                        </div>
                        <input type="hidden" class="end_time" name="end_time">
                    </form>
                @endif
            </div>
        @else
            <div class="h4 text-center mt-5 mb-5">Nothing to set</div>
        @endif
    </div>
@stop

@section('js_script')
    <script>
        $('#tokens').on('click',function(){
            $('.end_time').val(new Date(Date.parse(new Date()) + 3600 * 1000));
            alert($('.end_time').val());
        });
    </script>
@stop