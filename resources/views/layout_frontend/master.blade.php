<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title> {{ config('app.name') }} </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
          name="viewport">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
{{--    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>--}}
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-modern.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/now-ui-kit.css')}}" rel="stylesheet"/>
    @stack('css')
</head>
<body class="index-page">
<!-- Navbar -->
@include('layout_frontend.topbar')
<!-- End Navbar -->

<div class="wrapper">
    <div class="main">
        <div class="section">
            <div class="container">
                <h2 class="section-title">Xe bạn đã tìm kiếm</h2>
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/now-ui-kit.js')}}"></script>
@stack('js')
</body>
</html>
