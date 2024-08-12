@extends('layout.layout')
@section('title')

@endsection
@section('css')
    <style>
        .question-container {
            direction: rtl;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }

        .question {
            margin-bottom: 20px;
        }

        .question-text {
            font-weight: bold;
        }

        .answer-options label {
            display: block;
        }

        .answer-options input {
            margin-left: 10px;
        }

        .answer-explanation {
            margin-top: 10px;
        }

        .image-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            visibility: hidden;
        }

        .image-container.active {
            visibility: visible;
        }

        .image-container img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .image-viewer {
            width: 100%;
            height: 100vh;
            display: none;
            position: fixed;
            justify-content: space-around;
            align-items: center;
            z-index: 5;
        }

        .image-viewer img {
            width: 90%;
        }

        .close-button {
            width: 50px;
            height: 50px;
            line-height: 54px;
            color: white;
            background: red;
        }
    </style>
@endsection
@section('content')
    <div class="image-viewer">
        <button class="close-button rounded-5 border-0"><i class="fa fa-close"></i></button>
        <img src="null">
    </div>
    <div class="spinner-container">
        <div class="spinner-border text-danger loading-sp"></div>
    </div>
    <div class="mask"></div>
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <nav class="navbar navbar-dark bg-primary p-3 fixed-top m-2 rounded-4">
        <div>
{{--            <button class="btn btn-sm btn-danger" type="button">--}}
{{--                3 سوال از 12 سوال رو پاسخ دادید--}}
{{--            </button>--}}
            <button class="btn btn-sm btn-success" type="button">
                <span>زمان باقی‌مانده: <span id="countdown"></span> ثانیه </span>
            </button>
        </div>
    </nav>
    <div class="container" style="margin-top: 80px">
        <div class="question-container">
            <h1>{{$exam->title}}</h1>
            <hr/>
            @foreach($ques as $key => $item)
                @if($item->type=='test')
                    <div class="question @if(property_exists($item,'std_answer')) bg-secondary-subtle  @endif p-2"  >
                        <p class="question-text">سوال {{ $key+1 }}:</p>
                        <p>{{$item->text}}  (<b>{{$item->fasl}}</b>) <b style="color: red">{{$item->level}}</b></p>
                        @if($item->image!=null)
                            <button
                                class="show-image-btn btn btn-primary show-button mb-3"
                                data-image="{{ Storage::url('public/'.$item->image) }}"
                            >
                                نمایش عکس سوال
                            </button>
                        @endif
                        <div class="answer-options">
                            <label>
                                <input
                                    @if(property_exists($item,'std_answer'))
                                        @if($item->std_answer==1)
                                            checked
                                    @endif
                                    @endif
                                    class="answer-user" type="radio" que-id="{{$item->id}}"
                                    number-chose="{{$item->chose1}}" name="{{ $key+1 }}"/>
                                {{$item->chose1}}
                            </label>
                            <label>
                                <input
                                    @if(property_exists($item,'std_answer'))
                                        @if($item->std_answer==2)
                                            checked
                                    @endif
                                    @endif
                                    class="answer-user" type="radio" que-id="{{$item->id}}"
                                    number-chose="{{$item->chose2}}" name="{{ $key+1 }}"/>
                                {{$item->chose2}}
                            </label>
                            <label>
                                <input
                                    @if(property_exists($item,'std_answer'))
                                        @if($item->std_answer==3)
                                            checked
                                    @endif
                                    @endif
                                    class="answer-user" type="radio" que-id="{{$item->id}}"
                                    number-chose="{{$item->chose3}}" name="{{ $key+1 }}"/>
                                {{$item->chose3}}
                            </label>
                            <label>
                                <input
                                    @if(property_exists($item,'std_answer'))
                                        @if($item->std_answer==4)
                                            checked
                                    @endif
                                    @endif
                                    class="answer-user" type="radio" que-id="{{$item->id}}"
                                    number-chose="{{$item->chose4}}" name="{{ $key+1 }}"/>
                                {{$item->chose4}}
                            </label>
                        </div>
                    </div>
                @endif
            @endforeach
{{--            <div class="question">--}}
{{--                <p class="question-text">سوال تشریحی:</p>--}}
{{--                <p>متن سوال تشریحی</p>--}}
{{--                <textarea--}}
{{--                    class="form-control"--}}
{{--                    id="explanation"--}}
{{--                    name="explanation"--}}
{{--                    required--}}
{{--                ></textarea>--}}
{{--                <div class="mt-3">--}}
{{--                    <label for="formFile" class="form-label">آپلود عکس:</label>--}}
{{--                    <input class="form-control" type="file" id="formFile"/>--}}
{{--                </div>--}}
{{--                <div class="mt-2">--}}

{{--                    <div type="button" class="btn btn-primary btn-sm">عکس<a class="btn btn-danger"--}}
{{--                                                                            style="margin-right: 12px;"><i--}}
{{--                                class="fa fa-trash"></i></a></div>--}}
{{--                    <div type="button" class="btn btn-primary btn-sm">عکس<a class="btn btn-danger"--}}
{{--                                                                            style="margin-right: 12px;"><i--}}
{{--                                class="fa fa-trash"></i></a></div>--}}
{{--                    <div type="button" class="btn btn-primary btn-sm">عکس<a class="btn btn-danger"--}}
{{--                                                                            style="margin-right: 12px;"><i--}}
{{--                                class="fa fa-trash"></i></a></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <a href="/" class="btn btn-primary">خروج از آزمون</a>
        </div>
    </div>
    <div class="image-container">
        <img class="image" src=""/>
        <button class="btn btn-danger close-button">بستن</button>
    </div>
    @php
        use Hekmatinasser\Verta\Verta;
           $endDate = \Hekmatinasser\Verta\Verta::parse($exam->date.' '. $exam->time)->addMinutes($exam->deadline);
           $currentDateTime = new Verta();
           $timeForEnter = $currentDateTime->diffSeconds($endDate);
    @endphp

    <script>
        // تابع تبدیل ثانیه به دقیقه و ثانیه
        function convertSecondsToMinutesAndSeconds(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            return minutes + " دقیقه و " + remainingSeconds + " ثانیه";
        }

        // دریافت تفاوت زمانی از Laravel و تبدیل به دقیقه و ثانیه
        var timeDifference = {{ $timeForEnter }};
        var convertedTimeDifference = convertSecondsToMinutesAndSeconds(timeDifference);

        // نمایش تفاوت زمانی معکوس در اچ‌تی‌ام‌ال
        var countdownElement = document.getElementById("countdown");

        function updateCountdown() {
            if (timeDifference > 0) {
                countdownElement.innerHTML = convertedTimeDifference;
                timeDifference--;
                convertedTimeDifference = convertSecondsToMinutesAndSeconds(timeDifference);
                setTimeout(updateCountdown, 1000);
            } else {
                alert('زمان تمام شد')
                location.href = "{{route('enter_exam',['id'=>$exam->id])}}"
            }
        }

        // شروع به شمارش معکوس
        setTimeout(updateCountdown, 1000);

    </script>
@endsection
@section('js')
    <script>
        $('.show-image-btn').click(function (e) {
            var url = $(e.target).attr('data-image')
            $('.image-viewer img').attr('src', url)
            $('.mask').fadeIn()
            $('.image-viewer').css('display', 'flex')
        })
        $('.close-button').click(function (e) {
            $('.mask').fadeOut()
            $('.image-viewer').css('display', 'none')
        })

        $('.answer-user').click(function (e) {
            $('.spinner-container').css('display', 'flex');
            var formData = {
                que_id: $(e.target).attr('que-id'),
                answer: $(e.target).attr('number-chose'),
                exame_id: {{$exam->id}},
            };

            $.ajax({
                type: "post",
                url: '{{route('send_answer')}}',
                data: formData,
                dataType: "json",
                encode: true,
                success: function (response) {
                    if (response==1){
                        $('.spinner-container').fadeOut()
                        alertSucsses('عملیات موفق')
                        $(e.target).parents('.question').addClass('bg-secondary-subtle')
                    }
                }
            });
        })
    </script>
@endsection
