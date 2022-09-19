<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? '' }} - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    {{--    <link rel="shortcut icon" href="assets/images/favicon.ico">--}}

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="light-style"
          disabled="disabled">
    <link href="{{asset('css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
    @stack('css')
</head>

<body data-layout="detached"
      data-layout-config='{"leftSidebarCondensed":false,"darkMode":true, "showRightSidebarOnStart": false}'
      data-leftbar-theme="dark">

<!-- Topbar Start -->
@include('layout_backend.topbar')
<!-- end Topbar -->

<!-- Start Content-->
<div class="container-fluid">

    <!-- Begin page -->
    <div class="wrapper">

        @include('layout_backend.sidebar')

        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                @yield('breadcrumbs')
                            </div>
                            <h4 class="page-title">
                                {{$title ?? ''}}
                            </h4>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>

            @include('layout_backend.footer')

        </div> <!-- content-page -->

    </div> <!-- end wrapper-->
</div>
<!-- END Container -->
<!-- Right Sidebar -->
<div class="right-bar">

    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>

        <div class="p-3">
            <div class="alert alert-warning" role="alert">
                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
            </div>

            <!-- Settings -->
            <h5 class="mt-3">Color Scheme</h5>
            <hr class="mt-1"/>

            <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                       id="light-mode-check" checked/>
                <label class="custom-control-label" for="light-mode-check">Light Mode</label>
            </div>

            <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                       id="dark-mode-check"/>
                <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
            </div>

            <!-- Left Sidebar-->
            <h5 class="mt-4">Left Sidebar</h5>
            <hr class="mt-1"/>

            <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="compact" value="fixed" id="fixed-check"
                       checked/>
                <label class="custom-control-label" for="fixed-check">Scrollable</label>
            </div>

            <div class="custom-control custom-switch mb-1">
                <input type="radio" class="custom-control-input" name="compact" value="condensed"
                       id="condensed-check"/>
                <label class="custom-control-label" for="condensed-check">Condensed</label>
            </div>

            <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>
        </div> <!-- end padding-->

    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
<!-- bundle -->
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/helper.js')}}"></script>
@stack('js')
</body>
</html>
