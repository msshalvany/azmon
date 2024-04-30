<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/azmon/css/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" href="/azmon/css/style.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css"/>
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"
    ></script>
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
<div class="spinner-container">
    <div class="spinner-border text-danger loading-sp"></div>
</div>
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
@yield('content')
</body>
</html>
<script src="/azmon/js/jquery.js"></script>
<script src="/azmon/js/function.js"></script>
<script src="/azmon/js/bootstrap.bundle.min.js"></script>
<script src="/azmon/js/script.js"></script>
@yield('js')

