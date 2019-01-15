@extends('layouts.test')

@section('content')
    @if(Auth::user()->role == 'student')
        <input type="hidden" class="end_time" value="{{Auth::user()->activities()->find(14)->pivot->expired_at}}">
        <div class="panel panel-default" style="border: 1px solid black;">
            <div class="panel-body h3 mt-0" id="timer" style="position: fixed;right: 10%;">
                <div id="clockdiv" style="color:#656565;">
                    <span class="hours" style="border: 1px solid #656565; padding: 5px;border-radius: 3px;background: white;"></span> :
                    <span class="minutes" style="border: 1px solid #656565; padding: 5px;border-radius: 3px;background: white;"></span> :
                    <span class="seconds" style="border: 1px solid #656565; padding: 5px;border-radius: 3px;background: white;"></span>
                </div>
                <!--<div id="clockdiv">
                    <div>
                        <span class="hours"></span>
                        <div class="smalltext">Hours</div>
                    </div> :
                    <div>
                        <span class="minutes"></span>
                        <div class="smalltext">Minutes</div>
                    </div> :
                    <div>
                        <span class="seconds"></span>
                        <div class="smalltext">Seconds</div>
                    </div>
                </div>-->
            </div>
        </div>
    @endif
    <div style="padding-top: 20px;">
        <div class="h1 text-center">Department of CS GCU Lahore</div>
        <div style="margin-top: 20px;margin-bottom: 20px;">
            <span class="h3">Name : @if(Auth::user()->role == 'student') {{ Auth::user()->name }} @else Virtual View @endif</span>
            <span class="h3" style="padding-left: 120px;">BS(Computer Science) Entry Test</span>
            <span class="h3" style="padding-left: 120px;">Time Allowed : 60 minutes</span>
        </div>
            <?php
                $count=0;
            ?>
            @foreach($subsections as $subsection)
                    @foreach($subsection->questions as $question)
                        @foreach($paper_questions as $pquestion)
                            @if($question->id == $pquestion->id)
                                <div class="row" style="margin-left: 30px;">
                            <div class="col h5">Q#{{++$count}} : @if($question->pre_image<>'0')<img style="height: 130px; width: 150px;margin: 5px;border: 1px solid #606060;;" src="{{asset($question->pre_image)}}"><br> @endif
                                {{$question->statement}}</div>
                                    @if($question->post_image<>'0') <img style="height: 130px; width: 150px;border: 1px solid #606060" src="{{asset($question->post_image)}}"> @endif
                            <form>
                                <div class="form-group" id="options{{$count}}">
                                    @foreach($question->options as $option)
                                        <div style="margin-left: 30px;"><label class="radio-inline"><input type="radio" value="{{$option->id}}"
                                                     @foreach($option_question_user as $attempted)
                                                        @if($attempted->question_id==$question->id && $attempted->option_id==$option->id)
                                                            checked
                                                        @endif
                                                     @endforeach name="options_radio">{{$option->option}}</label></div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="q_id" value="{{$question->id}}">
                                <div class="form-group">
                                    @if(Auth::user()->role=='student')
                                        <button class="btn-submit btn btn-success"
                                                @foreach($option_question_user as $attempted)
                                                @if($attempted->question_id==$question->id)
                                                disabled
                                                @endif
                                                @endforeach value="{{$count}}">Submit</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                            @endif
                        @endforeach
                    @endforeach
            @endforeach
        @if(Auth::user()->role=='student')
            <div class="text-center form-group">
                <a href="{{route('tests.end', ['set' => '1'])}}" name="end_test" class="btn btn-danger">End Test</a>
            </div>
        @endif
    </div>
@stop

@section('js_script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn-submit").click(function(e){
            e.preventDefault();
            var q = document.getElementsByName('q_id');
            var o = document.getElementsByName('options');
            var current = $(this).val();
            var q_id = q[current-1].value;
            var o_id = $("#options"+ current +" input[type='radio']:checked").val();
            $.ajax({
                type:'POST',
                url:'{{route('tests.mark')}}',
                data:{o_id:o_id, q_id:q_id},
            });
            $(this).attr("disabled", "disabled");
        });
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                    //where to go on expiry
                    alert("Your time's up");
                    document.getElementsByName('end_test').click();
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        //var deadline = new Date(Date.parse(new Date()) + 3600 * 1000);
        var deadline = $('.end_time').val();
        initializeClock('clockdiv', deadline);

        function delete_cookie( name ) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
    </script>
@stop