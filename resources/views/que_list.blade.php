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
    </style>
@endsection
@section('content')
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
                        <ul>
                            <li>{{$item->chose1}}</li>
                            <li>{{$item->chose2}}</li>
                            <li>{{$item->chose3}}</li>
                            <li>{{$item->chose4}}</li>
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
                                    <form style="display: inline" action="{{route('del_que',['id'=>$item->id])}}" method="post">
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
                            <label class="input-group-text btn btn-success d-block m-auto" for="inputGroupFile">اپلود فایل اکسل</label>
                            <input type="file" class="form-control d-none" name="file"  id="inputGroupFile">
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
