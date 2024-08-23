@extends('layout.layout')
@section('title')
    لیست  سوالات
@endsection
@section('css')

@endsection
@section('content')
    <div class="container ">
        <br>
        <nav aria-label="breadcrumb" class="mx-5">
            <ol class="breadcrumb">
                <li><a href="{{route('exame-list')}}">لیست آزمون ها</a></li>
                <li><a href="{{route('que_list',['id'=>$id])}}">لیست سوالات</a></li>
                <li>ساخت سوال جدید</li>
            </ol>
        </nav>
        <ul class="nav nav-tabs mt-4">
            <li class="nav-item">
                <a class="nav-link " data-toggle="pill" href="#menu2">تشریحی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#menu3">تستی</a>
            </li>
        </ul>
        <div class="tab-content m-4 p-2 bg-body-secondary">
            <div id="menu2" class="tab-pane fade ">
                <!-- فرم اول -->
                <form action="{{route('create_que',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                  <textarea
                      class="form-control"
                      placeholder="Leave a comment here"
                      id="floatingTextarea2"
                      name="text"
                      style="height: 100px"
                  ></textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label"
                            >اگر سوال دارای عکس هستش اپلود کنید :</label
                            >
                            <input class="form-control" name="image" type="file" id="formFile"/>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-danger" disabled type="submit">
                                    ارسال (در حال حاضر نرم افزار پشتیبانی نمیکند)
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="menu3" class="tab-pane fade show active">
                <form action="{{route('create_que',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                  <textarea
                      class="form-control"
                      placeholder="Leave a comment here"
                      id="floatingTextarea2"
                      name="text"
                      style="height: 100px"
                  ></textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label"
                            >اگر سوال دارای عکس هستش اپلود کنید :</label
                            >
                            <input class="form-control" type="file" name="image" id="formFile"/>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"
                            >گزینه 1</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassword"
                                    name="chose1"
                                />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"
                            >گزینه 2</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassword"
                                    name="chose2"
                                />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"
                            >گزینه 3</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassword"
                                    name="chose3"
                                />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"
                            >گزینه 4</label
                            >
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputPassword"
                                    name="chose4"
                                />
                            </div>
                        </div>
                        <h4>جواب :</h4>
                        <div class="d-flex justify-content-around w-50 flex-wrap">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answer"
                                    id="answer"
                                    value="1"
                                    checked
                                />
                                <label class="form-check-label" for="flexRadioDefault1">
                                    گزینه 1
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answer"
                                    id="answer"
                                    value="2"
                                />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    گزینه 2
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answer"
                                    id="answer"
                                    value="3"
                                />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    گزینه 3
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answer"
                                    id="answer"
                                    value="4"
                                />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    گزینه 4
                                </label>
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"
                            >فصل کتاب :</label
                            >
                            <div class="col-sm-3">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="inputPassword"
                                        name="fasl"
                                />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="level" class="col-sm-2 col-form-label"
                            > درجه سختی :</label
                            >
                            <div class="col-sm-3">
                                <select
                                        type="text"
                                        class="form-control"
                                        id="level"
                                        name="level">
                                    <option value="ساده">ساده</option>
                                    <option value="سختی">سخت</option>
                                    <option value="چالشی">چالشی</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">
                                    ارسال
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @if ($errors->any())
        <script>
            alertEore('اطلاعات را صحیح وارد کنید')
        </script>
    @endif
@endsection
