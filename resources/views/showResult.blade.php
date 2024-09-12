@extends('layout.layout')
@section('title')
    آزمون {{$exam->title}}
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
            max-width: 95%;
            max-height: 95vh;
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
    <div class="container" style="margin-top: 80px">
        <div class="question-container">
            <h1>{{$exam->title}}</h1>
            @php
                $stds = \App\Models\std_exame::where('exame_id', $exam->id)->get();
                if ($exam->presses != 1) {
                    foreach ($stds as $item) {
                        $std_ques = json_decode($item->ques);
                        $score = 0;
                        foreach ($std_ques as $item2) {
                            if (property_exists($item2, 'std_answer')) {
                                if ($item2->answer == $item2->std_answer) {
                                    $score++;
                                }
                            }
                        }
                        \App\Models\std_exame::find($item->id)->update([
                            'score' => $score
                        ]);
                        $exam->update([
                            'presses' => 1
                        ]);
                    }
                }
                $exam = \App\Models\exame::find($exam->id);
                $std = \App\Models\std_exame::find($std->id);
            @endphp

            از {{$exam->count}} سوال  به  {{$std->score}} جواب صحیح داده
                  ، نرمه نهایی شما  {{($std->score*20)/$exam->count}}
            <hr/>
            @foreach($ques as $key => $item)
                @if($item->type=='test')
                    <div class="question @if(property_exists($item,'std_answer')) bg-secondary-subtle  @endif p-2">
                        <p class="question-text">سوال {{ $key+1 }}:</p>
                        <p>{{$item->text}}  (<b>{{$item->fasl}}</b>) <b style="color: red">{{$item->level}}</b><b>  ترم {{$item->term }} </b></p>
                        @if($item->image!=null)
                            {{--                            <button--}}
                            {{--                                class="show-image-btn btn btn-primary show-button mb-3"--}}
                            {{--                                data-image="{{ Storage::url('public/'.$item->image) }}"--}}
                            {{--                            >--}}
                            {{--                                نمایش عکس سوال--}}
                            {{--                            </button>--}}
                            <img src="{{ Storage::url('public/'.$item->image) }}" alt="سوال" style="max-width: 300px">
                        @endif
                        <div class="answer-options">
                            <label class="mt-2 rounded-5 p-2
                             @if($item->std_answer==1 && $item->answer==1) bg-success text-white
                             @elseif($item->answer==1) bg-success text-white
                             @elseif($item->std_answer==1) bg-danger text-white
                             @endif
                             ">
                                {{$item->chose1}}
                                @if($item->chose1img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose1img) }}">نمایش عکس جواب
                                    </button>
                                @endif
                            </label>
                            <label class="mt-2 rounded-5 p-2
                             @if($item->std_answer==2 && $item->answer==2) bg-success text-white
                             @elseif($item->answer==2) bg-success text-white
                             @elseif($item->std_answer==2) bg-danger text-white
                             @endif
                            ">
                                {{$item->chose2}}
                                @if($item->chose2img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose2img) }}">نمایش عکس جواب
                                    </button>
                                @endif
                            </label>
                            <label class="mt-2 rounded-5 p-2
                             @if($item->std_answer==3 && $item->answer==3) bg-success text-white
                             @elseif($item->answer==3) bg-success text-white
                             @elseif($item->std_answer==3) bg-danger text-white
                             @endif
                            ">
                                {{$item->chose3}}
                                @if($item->chose3img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose3img) }}">نمایش عکس جواب
                                    </button>
                                @endif
                            </label>
                            <label class="mt-2 rounded-5 p-2
                             @if($item->std_answer==4 && $item->answer==4) bg-success text-white
                             @elseif($item->answer==4) bg-success text-white
                             @elseif($item->std_answer==4) bg-danger text-white
                             @endif
                            ">
                                {{$item->chose4}}
                                @if($item->chose4img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose4img) }}">نمایش عکس جواب
                                    </button>
                                @endif
                            </label>
                        </div>
                    </div>
                @endif
            @endforeach
            <a href="/" class="btn btn-primary">خروج از آزمون</a>
        </div>
    </div>
    <div class="image-container">
        <img class="image" src=""/>
        <button class="btn btn-danger close-button">بستن</button>
    </div>
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
    </script>
@endsection
