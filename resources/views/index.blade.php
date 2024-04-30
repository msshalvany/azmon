@extends('layout.layout')
@section('title')
    صفحه اصلی
@endsection
@section('css')

@endsection
@section('content')

    <div class="container-login">
        <h1 class="text-center mb-5">نرم افزار برگزاری آزمون</h1>
        <div class="w-100 text-center">
            <div class="buttons-forms btn-group" style="width: 300px;">
                <button class="btn btn-outline-danger show-planer-form" id="button1">طراحی آزمون</button>
                <button class="btn btn-outline-success show-examer-form" id="button2">شروع آزمون</button>
            </div>
        </div>
        <div class="form2">
            <!-- فرم اول -->
            <form action="{{route('login_exam')}}" method="get" class="bg-body-tertiary p-4 rounded-5">
                @csrf
                <div class="row gy-1 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="exam_code" id="exam_code"
                                   placeholder="name@example.com" required>
                            <label for="exam_code" class="form-label">شناسه آزمون</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="std_code" id="std_code" value=""
                                   placeholder="Password" required>
                            <label for="password" class="form-label">شناسه کاربری (میتواند شماره دانشجویی یا کد ملی
                                باشد) </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn bsb-btn-2xl btn-primary" type="submit">ارسال</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-grid">
                            <button class="btn bsb-btn-2xl btn-danger back-to-btn-form" type="submit">برگشت</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="form1">
            <!-- فرم دوم -->
            <form action="{{route('login_user')}}" method="post" class="bg-body-tertiary p-4 rounded-5">
                @csrf
                <div class="row gy-1 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="name@example.com" required>
                            <label for="email" class="form-label">ایمیل</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" value=""
                                   placeholder="Password" required>
                            <label for="password" class="form-label">رمز عبور</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <a class="m-2" href="/register">ثبت نام</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn bsb-btn-2xl btn-primary" type="submit">ارسال</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-grid">
                            <button class="btn bsb-btn-2xl btn-danger back-to-btn-form" type="submit">برگشت</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    @if(session()->has('loginErr'))
        <script>
            alertEore('اطلاعات وارد شده اشتباه است')
            $('.form2').fadeOut();
            $('.buttons-forms').fadeOut();
            setTimeout(() => {
                $('.form1').fadeIn();
            }, 500);
        </script>
    @endif
    @if(session()->has('exam_login_err'))
        <script>
            alertEore('اطلاعات وارد شده اشتباه است')
            $('.form1').fadeOut();
            $('.buttons-forms').fadeOut();
            setTimeout(() => {
                $('.form2').fadeIn();
            }, 500);
        </script>
    @endif
@endsection
