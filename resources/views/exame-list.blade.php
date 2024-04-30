@extends('layout.layout')
@section('title')
    لیست ازمون ها
@endsection
@section('css')

@endsection
@section('content')

    <h1 class="text-center mt-5">لیست آزمون های شما</h1>
    <div class="w-100 d-flex justify-content-center">
        <div class="list-group col-11">
            @if(count($exame)==0)
                <h3 class="text-center mt-5"> آزمونی ایجاد نشده</h3>
            @endif
            @foreach($exame as $item)
                @php
                    $currentDateTime = new Verta();
                    $date = \Hekmatinasser\Verta\Verta::parse($item->date.' '. $item->time);
                    $endDate = \Hekmatinasser\Verta\Verta::parse($item->date.' '. $item->time)->addMinutes($item->deadline);
                    $timeForEnter = $currentDateTime->diffMinutes($endDate);
                @endphp
                <div
                    class="list-group-item list-group-item-dark mt-2 d-flex justify-content-between align-items-center flex-wrap "
                    @if($endDate->isPast()) style="background: #ff9292" @endif
                >
                    <div>
                        {{$item->title}}<br>
                        <b>کد ورود به آزمون : {{$item->exam_code}}</b>
                        <div>
                            <span
                                class="badge badge-primary badge-pill bg-primary">زمان برگزاری : {{$item->date}}  -  {{$item->time}}</span>
                            <span
                                class="badge badge-primary badge-pill bg-danger">مدت زمان  :  {{ $item->deadline }}</span>
                            <span class="badge badge-primary badge-pill bg-success">{{ $item->type }}</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button
                            type="button"
                            class="btn btn-danger m-1"
                            data-toggle="modal"
                            data-target="#myModal"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                        @if(!    $endDate->isPast())
                            <a
                                class="btn btn-primary m-1"
                                href="{{route('exame_edit_v',['id'=>$item->id])}}"
                            >
                                <i class="fa fa-edit"></i>
                            </a>
                        @endif
                        @if($endDate->isPast())
                            <a
                                class="btn btn-warning m-1"
                                href="{{route('result_exame',['id'=>$item->id])}}"
                            >
                                مشاهده نتایج
                            </a>
                        @endif
                        <a
                            class="btn btn-success m-1"
                            href="{{route('que_list',['id'=>$item->id])}}"
                        >
                            بخش سوالات
                            <i class="fa fa-question"></i>
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
                                    <form style="display: inline" action="{{route('del_exame',['id'=>$item->id])}}"
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
                <a href="{{route('make-exame')}}" class="btn btn-primary">ساخت ازمون جدید</a>
            </div>
        </div>
    </div>
@endsection
