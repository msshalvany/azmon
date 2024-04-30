@extends('layout.layout')
@section('title')
    ثبت نام
@endsection
@section('css')

@endsection
@section('content')
    <h1 class="text-center mt-5">ثبت نام</h1>
    <div class="container-login">
        <div class="forms rounded-2 p-3 bg-body-secondary">
            <div class="email-form">
                <!-- فرم اول -->
                <form class="get_email" action="{{route('get_email')}}" method="post">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    placeholder="name@example.com"
                                    required
                                />
                                <label for="email" class="form-label">ایمیل خود را وارد کنید</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">
                                    ارسال
                                </button>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-grid">
                                <a
                                    class="btn bsb-btn-2xl btn-danger back-to-btn-form"
                                    href="/"
                                >
                                    برگشت
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="veryfy-email">
                <!-- فرم دوم -->
                <p class="text-danger">به ایمیل شما کدی ارسال شد برای احراز هویت انرا اینجا وارد کنید</p>
                <form class="veryfy-email" action="{{route('verify_email')}}" method="post">
                    @csrf
                    <div class="row gy-1 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="code"
                                    id="code"
                                    placeholder="name@example.com"
                                    required
                                />
                                <label for="email" class="form-label">کد ایمیل شده را وارد کنید</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-2xl btn-primary" type="submit">
                                    ارسال
                                </button>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-grid">
                                <a
                                    class="btn bsb-btn-2xl btn-danger back-to-btn-form"
                                    href="/"
                                >
                                    برگشت
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.get_email').submit(function (e) {
            e.preventDefault()
            $('.spinner-container').css('display', 'flex');
            var formData = {
                email: $("#email").val(),
            };
            $.ajax({
                type: "post",
                url: "/get_email",
                data: formData,
                dataType: "json",
                encode: true,
                success: function (response) {
                    console.log(response)
                    if (response == 1) {
                        setTimeout(function () {
                            $('.spinner-container').fadeOut();
                        }, 1000)
                        $('.email-form').fadeOut();
                        $('.veryfy-email').fadeIn();
                    } else if (response == 2) {
                        setTimeout(function () {
                            $('.spinner-container').fadeOut();
                        }, 1000)
                        alertEore('شما قبلا ثبت نام کردی')
                    } else {
                        setTimeout(function () {
                            $('.spinner-container').fadeOut();
                        }, 1000)
                        alertEore('خطایی رخ داده')
                    }

                }
            });
        })
        $('.veryfy-email').submit(function (e) {
            e.preventDefault()
            $('.spinner-container').css('display', 'flex');
            var formData = {
                code: $("#code").val(),
            };

            $.ajax({
                type: "post",
                url: "/verify_email",
                data: formData,
                dataType: "json",
                encode: true,
                success: function (response) {
                    console.log(response)
                    if (response == 1) {
                        setTimeout(function () {
                            $('.spinner-container').fadeOut();
                        }, 1000)
                        location.href = '/complete-info'
                    } else {
                        setTimeout(function () {
                            $('.spinner-container').fadeOut();
                        }, 1000)
                        alertEore('خطایی رخ داده')
                    }
                }
            });
        })
    </script>
@endsection
