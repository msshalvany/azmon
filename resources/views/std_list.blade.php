@extends('layout.layout')
@section('title')
    نتیجه آزمون
@endsection
@section('css')

@endsection
@section('content')
    <h1 class="text-center mt-5">نتیجه آزمون</h1>
    <nav aria-label="breadcrumb" class="mx-5">
        <ol class="breadcrumb">
            <li><a href="{{route('exame-list')}}">لیست آزمون ها</a></li>
            <li>نتیجه آزمون</li>
        </ol>
    </nav>
    <div class="w-100 d-flex justify-content-center">
        <div class="list-group col-11">
            @foreach($std as $item)
                <div class="list-group-item list-group-item-dark mt-2 d-flex justify-content-between align-items-center flex-wrap ">
                    <div>
                        {{$item->title}}<br>
                        <b>شناسه کاربری : {{$item->std_code}}</b>
                    </div>
                    <div class="text-center">
                        @php

                        @endphp
                        <button
                                type="button"
                                class="btn btn-danger m-1"
                                data-toggle="modal"
                                data-target="#myModal"
                        >
                           از {{$exame->count}} سوال  به  {{$item->score}} جواب صحیح داده
                        </button>
                    </div>
                </div>
            @endforeach
{{--            <div class="col-12 text-center mt-4">--}}
{{--                <a href="{{route('make-exame')}}" class="btn btn-primary">ساخت ازمون جدید</a>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
