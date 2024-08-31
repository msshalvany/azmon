@extends('layout.layout')

@section('title')
    ویرایش سوال
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
    <div class="container">
        <br>
        <nav aria-label="breadcrumb" class="mx-5">
            <ol class="breadcrumb">
                <li><a href="{{ route('exame-list') }}">لیست آزمون‌ها</a></li>
                <li><a href="{{ route('que_list', ['id' => $question->exame_id]) }}">لیست سوالات</a></li>
                <li>ویرایش سوال</li>
            </ol>
        </nav>
        <ul class="nav nav-tabs mt-4">
            <li class="nav-item">
                <a class="nav-link @if($question->type == 'des') active @endif" data-toggle="pill"
                   href="#menu2">تشریحی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($question->type == 'test') active @endif" data-toggle="pill"
                   href="#menu3">تستی</a>
            </li>
        </ul>
        <div class="tab-content m-4 p-2 bg-body-secondary">
            <div id="menu2" class="tab-pane fade @if($question->type == 'des') show active @endif">
                <form action="{{ route('edit_que', ['id' => $question->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="floatingTextarea2" name="text"
                                          style="height: 100px">{{ $question->text }}</textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">اگر سوال دارای عکس هستش آپلود کنید :</label>
                            <input class="form-control" type="file" name="image" id="formFile"/>
                            @if($question->image)
                                <img style="width: 200px" src="{{ Storage::url('public/'.$question->image) }}"
                                     alt="تصویر"/>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">ارسال</button>
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
            <div id="menu3" class="tab-pane fade @if($question->type == 'test') show active @endif">
                <form action="{{ route('edit_que', ['id' => $question->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="floatingTextarea2" name="text"
                                          style="height: 100px">{{ $question->text }}</textarea>
                                <label for="floatingTextarea2">عنوان سوال</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">اگر سوال دارای عکس هستش آپلود کنید :</label>
                            <input class="form-control" type="file" name="image" id="formFile"/>
                            @if($question->image)
                                <img style="width: 200px" src="{{ Storage::url('public/'.$question->image) }}"
                                     alt="تصویر"/>
                            @endif
                        </div>
                        <div class="mb-3 row bg-dark-subtle p-4">
                            <label for="inputPassword" class="col-sm-2 col-form-label">گزینه 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="chose1"
                                       value="{{ $question->chose1 }}"/>
                                <div class="input-group custom-file-button col-2">
                                    <label class="input-group-text btn btn-success mt-3" for="inputGroupFile">اگر جواب
                                        عکس است آپلود کنید</label>
                                    <input type="file" class="form-control mt-3" name="chose1img" id="inputGroupFile">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row bg-dark-subtle p-4">
                            <label for="inputPassword" class="col-sm-2 col-form-label">گزینه 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="chose2"
                                       value="{{ $question->chose2 }}"/>
                                <div class="input-group custom-file-button col-2">
                                    <label class="input-group-text btn btn-success mt-3" for="inputGroupFile2">اگر جواب
                                        عکس است آپلود کنید</label>
                                    <input type="file" class="form-control mt-3" name="chose2img" id="inputGroupFile2">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row bg-dark-subtle p-4">
                            <label for="inputPassword" class="col-sm-2 col-form-label">گزینه 3</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="chose3"
                                       value="{{ $question->chose3 }}"/>
                                <div class="input-group custom-file-button col-2">
                                    <label class="input-group-text btn btn-success mt-3" for="inputGroupFile3">اگر جواب
                                        عکس است آپلود کنید</label>
                                    <input type="file" class="form-control mt-3" name="chose3img" id="inputGroupFile3">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row bg-dark-subtle p-4">
                            <label for="inputPassword" class="col-sm-2 col-form-label">گزینه 4</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="chose4"
                                       value="{{ $question->chose4 }}"/>
                                <div class="input-group custom-file-button col-2">
                                    <label class="input-group-text btn btn-success mt-3" for="inputGroupFile4">اگر جواب
                                        عکس است آپلود کنید</label>
                                    <input type="file" class="form-control mt-3" name="chose4img" id="inputGroupFile4">
                                </div>
                            </div>
                        </div>
                        <h4>جواب :</h4>
                        <div class="d-flex justify-content-around w-50 flex-wrap">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="answer1" value="1"
                                       @if($question->answer == '1') checked @endif />
                                <label class="form-check-label" for="answer1">گزینه 1</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="answer2" value="2"
                                       @if($question->answer == '2') checked @endif />
                                <label class="form-check-label" for="answer2">گزینه 2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="answer3" value="3"
                                       @if($question->answer == '3') checked @endif />
                                <label class="form-check-label" for="answer3">گزینه 3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="answer4" value="4"
                                       @if($question->answer == '4') checked @endif />
                                <label class="form-check-label" for="answer4">گزینه 4</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">ارسال</button>
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
