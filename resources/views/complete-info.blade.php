@extends('layout.layout')
@section('title')
    تکمیل اطلاعات
@endsection
@section('css')

@endsection
@section('content')
    <h1 class="text-center mt-5">تکمیل اطلاعات</h1>
    <div class=" d-flex align-items-center justify-content-center bg-body-secondary p-2"
         style="width: fit-content;margin: auto;">
        <form action="{{route('create_user')}}" method="post">
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            name="firstname"
                            id="firstname"
                            placeholder=""
                            required
                        />
                        <label for="email" class="form-label"
                        >نام</label
                        >
                    </div>
                </div>
                <div class="floatin col">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            name="lastname"
                            id="lastname"
                            placeholder=""
                            required
                        />
                        <label for="email" class="form-label"
                        >نام خوانوادگی</label
                        >
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-floating">
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    placeholder=""
                    required
                />
                <label for="email" class="form-label">یک رمز عبر برای ورد خود انتخاب کنید</label>
            </div>

            <!-- Text input -->
            <button
                data-mdb-ripple-init
                type="submit"
                class="btn btn-primary btn-block mt-3"
            >
                ارسال
            </button>
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
@endsection
