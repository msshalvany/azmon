@extends('layout.layout')
@section('title')
    ایجاد آزمون
@endsection
@section('css')

@endsection
@section('content')
    <h1 class="text-center mt-5">اطلاعات آزمون</h1>

    <br>
    <nav aria-label="breadcrumb" class="mx-5">
        <ol class="breadcrumb">
            <li><a href="{{route('exame-list')}}">لیست آزمون ها</a></li>
            <li>ساخت آزمون</li>
        </ol>
    </nav>
    <div
        class="m-auto d-flex align-items-center justify-content-center bg-body-secondary p-5"
    >
        <form class="w-75" action="{{route('edit_exame',['id'=>$exmae->id])}}" method="post">
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->

            <!-- Text input -->
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control form-control-sm"
                    name="title"
                    id="title"
                    placeholder=""
                    required
                    value="{{$exmae->title}}"
                />
                <label for="email" class="form-label">عنوان آزمون</label>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="form-floating">
                        <input
                            type="number"
                            class="form-control"
                            name="count"
                            id="count"
                            placeholder=""
                            required
                            value="{{$exmae->count}}"
                        />
                        <label for="count" class="form-label"
                        >تعدا سوالات برای نمایش
                        </label>
                    </div>
                </div>
                <div class="floatin col">
                    <div class="form-floating">
                        <input
                            type=""
                            class="form-control"
                            name="name"
                            id="name"
                            placeholder=""
                            required
                            value="{{$exmae->count}}"
                        />
                        <label for="name" class="form-label">نام طراح</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select
                                class="form-select"
                                id="floatingSelectGrid"
                                name="type"
                                aria-label="Floating label select example"
                            >
                                <option value="0"></option>
                                <option @if($exmae->type='تشریحی') selected @endif value="تشریحی">تشریحی</option>
                                <option @if($exmae->type='تستی') selected @endif value="تستی">تستی</option>
                                <option @if($exmae->type='تستس تشریحی') selected @endif value="تستس تشریحی">تستس تشریحی</option>
                            </select>
                            <label for="floatingSelectGrid">نوع ازمون</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-check form-switch">
                <input
                    class="form-check-input"

                    type="checkbox"
                    name="rand_choice"
                    id="flexSwitchCheckDefault"
                    value="1"
                    @if($exmae->rand_choice)checked @endif
                />
                <label class="form-check-label" for="flexSwitchCheckDefault">
                    گزینه سوالات تصادفی</label
                >
            </div>
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="flexSwitchCheckDefault"
                    name="rand_que"
                    value="1"
                    @if($exmae->rand_que)checked @endif

                />
                <label class="form-check-label" for="flexSwitchCheckDefault">
                    ترتیب سوالات تصادفی
                </label>
            </div>
            <label autocomplete="off" class="form-label mt-4" for="">انتخاب تاریخ ازمون : </label>
            <input  value="{{$exmae->date}}" name="date" class="form-control w-auto" data-jdp/>
            <script>
                jalaliDatepicker.startWatch();
            </script>
            <div class="" style="width: fit-content">
                <label autocomplete="off" class="form-label mt-3" for="">زمان شروع آزمون : </label>
                <input  value="{{$exmae->time}}" name="time" class="form-control" checked type="time"/>
            </div>
            <div class="" style="width: fit-content">
                <label class="form-label mt-3" for=""
                >مدت زمان آزمون به دقیقه :</label
                >
                <input value="{{$exmae->deadline}}" name="deadline" class="form-control" checked type="number"/>
            </div>
            <!-- Text input -->
{{--            <a--}}
{{--                data-mdb-ripple-init--}}
{{--                type="button"--}}
{{--                class="btn btn-primary btn-block mt-3"--}}
{{--            >رفتن به بخش سوالات<span--}}
{{--                    class="badge badge-primary badge-pill bg-danger"--}}
{{--                    style="margin-right: 12px"--}}
{{--                >--}}
{{--            14 سوال طراحی شده--}}
{{--                </span>--}}
{{--            </a>--}}
            <input data-mdb-ripple-init
                   type="submit"
                   class="btn btn-primary btn-block mt-3 w-100"
                   value="ثبت"
            >
        </form>
    </div>
@endsection
