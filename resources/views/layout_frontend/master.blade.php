<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>{{ config('app.name') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <link href="{{asset('css/icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/app-modern.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/paper-kit.css_v=2.1.0.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/demo.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    {{--    <link href="assets/css/nucleo-icons.css" rel="stylesheet">--}}
    @stack('css')
</head>
<body>
<!-- Navbar -->
@include('layout_frontend.topbar')
<!-- End Navbar -->

<!-- Content -->
<div class="wrapper">
    @yield('content')
</div>
<!-- End Content -->

{{--<!-- Footer -->--}}
{{--@include('layout_frontend.footer')--}}
{{--<!-- End Footer -->--}}
</body>

<!--   Core JS Files   -->
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/paper-kit_v=2.1.0.js')}}"></script>
@stack('js')
</html>
