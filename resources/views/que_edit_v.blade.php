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
                <li><a href="{{route('que_list',['id'=>$question->exame_id])}}">لیست سوالات</a></li>
                <li>ساخت سوال جدید</li>
            </ol>
        </nav>
        <div class="tab-content m-4 p-2 bg-body-secondary">
            <div id="menu2" class="tab-pane fade @if($question->type=='des') show active @endif">
                <!-- فرم اول -->
                <form action="{{route('edit_que',['id'=>$question->id])}}" method="post" enctype="multipart/form-data">
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
                  >{{$question->text}}</textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label"
                            >اگر سوال دارای عکس هستش اپلود کنید :</label
                            >
                            <input class="form-control" value="{{ Storage::url('public/'.$question->image) }}" name="image" type="file" id="formFile"/>
                            <img style="width: 200px" src="{{ Storage::url('public/'.$question->image) }}" alt="تصویر" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">
                                    ارسال
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="mt-2">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>{{ $error }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
            <div id="menu3" class="tab-pane fade @if($question->type=='test') show active @endif">
                <form  action="{{route('edit_que',['id'=>$question->id])}}" method="post" enctype="multipart/form-data">
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
                  >{{$question->text}}</textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label"
                            >اگر سوال دارای عکس هستش اپلود کنید :</label
                            >
                            <input class="form-control" value="{{ Storage::url('public/'.$question->image) }}" name="image" type="file" id="formFile"/>
                            <img style="width: 200px" src="{{ Storage::url('public/'.$question->image) }}" alt="تصویر" />
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
                                    value="{{$question->chose1}}"
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
                                    value="{{$question->chose2}}"
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
                                    value="{{$question->chose3}}"
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
                                    value="{{$question->chose4}}"
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
                                    @if($question->answer=='1') checked @endif
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
                                    @if($question->answer=='2') checked @endif
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
                                    @if($question->answer=='3') checked @endif
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
                                    @if($question->answer=='4') checked @endif
                                />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    گزینه 4
                                </label>
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="mt-2">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>{{ $error }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
