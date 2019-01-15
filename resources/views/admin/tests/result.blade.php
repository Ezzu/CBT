@extends('layouts.test')

@section('content')
    <div class="h1 text-center">Have a deep breath {{Auth::user()->name}} !</div>
    <div class="h2 text-center">Department of Computer Science Entry Test Result Summary</div>
    <div class="h3 text-center text-primary"><i class="fas fa-clipboard-list"></i> Questions Attempted : {{$attempted}}/50</div>
    <div style="padding: 10px;border-radius: 5px;background: white;text-align: center;">
        <div class="h3 text-success"><i class="fa fa-thumbs-up"></i> Correct : {{$corrected}}</div>
        <div class="h3 text-danger"><i class="fa fa-thumbs-down"></i> Wrong : {{$attempted - $corrected}}</div>
    </div>
@stop