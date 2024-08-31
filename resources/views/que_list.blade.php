@extends('layout.layout')
@section('title')
    لیست ازمون ها
@endsection
@section('css')
    <style>
        .custom-file-button input[type=file] {
            margin-left: -2px !important;
        }

        .custom-file-button input[type=file]::-webkit-file-upload-button {
            display: none;
        }

        .custom-file-button input[type=file]::file-selector-button {
            display: none;
        }

        .custom-file-button:hover label {
            background-color: #dde0e3;
            cursor: pointer;
        }

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
            max-width: 950%;
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
    <h1 class="text-center mt-5">لیست سوالات های شما</h1>
    <nav aria-label="breadcrumb" class="mx-5">
        <ol class="breadcrumb">
            <li><a href="{{route('exame-list')}}">لیست آزمون ها</a></li>
            <li>لیست سوالات</li>
        </ol>
    </nav>
    <div class="w-100 d-flex justify-content-center">
        <div class="list-group col-11">
            @if(count($que)==0)
                <h3 class="text-center mt-5"> سوالی ایجاد نشده</h3>
            @endif
            @foreach($que as $item)
                <div
                        class="list-group-item list-group-item-dark mt-2 d-flex justify-content-between"
                >
                    <div>
                        <p>{{$item->text}}</p>
                        @if($item->image!=null)
                            <button class="show-image-btn btn btn-primary show-button mb-3"
                                    data-image="{{ Storage::url('public/'.$item->image) }}">نمایش عکس سوال
                            </button>
                            {{--                            <img src="{{ Storage::url('public/'.$item->image) }}" alt="سوال" style="max-width: 300px">--}}
                        @endif
                        <ul class="d-flex flex-column">
                            <li class="d-flex align-items-center mb-2">
                                <b class="flex-grow-1">الف) {{$item->chose1}} </b>
                                @if($item->chose1img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose1img) }}">نمایش عکس سوال
                                    </button>
                                @endif
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <b class="flex-grow-1">ب) {{$item->chose2}} </b>
                                @if($item->chose2img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose2img) }}">نمایش عکس سوال
                                    </button>
                                @endif
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <b class="flex-grow-1">ج) {{$item->chose3}} </b>
                                @if($item->chose3img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose3img) }}">نمایش عکس سوال
                                    </button>
                                @endif
                            </li>
                            <li class="d-flex align-items-center">
                                <b class="flex-grow-1">د) {{$item->chose4}} </b>
                                @if($item->chose4img!=null)
                                    <button class="show-image-btn btn btn-primary show-button"
                                            data-image="{{ Storage::url('public/'.$item->chose4img) }}">نمایش عکس سوال
                                    </button>
                                @endif
                            </li>
                        </ul>

                        <div>
                            {{--                            <span--}}
                            {{--                                class="badge badge-primary badge-pill bg-primary">زمان برگزاری : {{$item->date}}  -  {{$item->time}}</span>--}}
                            {{--                            <span--}}
                            {{--                                class="badge badge-primary badge-pill bg-danger">مدت زمان  : {{ $item->deadline }}</span>--}}
                            <span class="badge badge-primary badge-pill bg-success">{{ $item->type }}</span>
                            <span class="badge badge-primary badge-pill bg-danger">جواب گزینه :{{ $item->answer }}</span>
                            <span class="badge badge-primary badge-pill bg-warning">فصل : {{$item->fasl}}</span>
                            <span class="badge badge-primary badge-pill bg-secondary">درجه سختی : {{$item->level}}</span>
                        </div>
                    </div>
                    <div>
                        <button
                                type="button"
                                class="btn btn-danger"
                                data-toggle="modal"
                                data-target="#myModal"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                        <a
                                class="btn btn-primary"
                                href="{{route('que_edit_v',['id'=>$item->id])}}"
                        >
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <p class="modal-title">ایا از از این کار اطمینان دارید</p>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <button class="btn btn-danger" data-dismiss="modal">
                                        کنسل
                                    </button>
                                    <form style="display: inline" action="{{route('del_que',['id'=>$item->id])}}"
                                          method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-success">
                                            تایید
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12 text-center mt-4">
                <a href="{{route('make_que',['id'=>$exame_id])}}" class="btn btn-primary">ساخت سوال جدید</a>
                <form class="importExel" action="{{route('importExel')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container mt-3 py-3 ">
                        <div class="input-group custom-file-button text-center">
                            <label class="input-group-text btn btn-success d-block m-auto" for="inputGroupFile">اپلود
                                فایل اکسل</label>
                            <input type="file" class="form-control d-none" name="file" id="inputGroupFile">
                            <input type="hidden" name="exame_id" value="{{$exame_id}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
