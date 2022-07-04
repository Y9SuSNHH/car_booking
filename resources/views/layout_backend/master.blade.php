<html lang="en" class="mm-active">
<head>
    <meta charset="utf-8">
    <title>Calendar | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
{{--    <link rel="shortcut icon" href="assets/images/favicon.ico">--}}

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="light-style"
          disabled="disabled">
    <link href="{{asset('css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="light-style">

</head>

<body class="mm-show" data-layout="detached"
      data-layout-config="{&quot;leftSidebarCondensed&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}"
      data-leftbar-theme="dark">

<!-- Topbar Start -->
@include('layout_backend.topbar')
<!-- end Topbar -->

<!-- Start Content-->
<div class="container-fluid mm-active">

    <!-- Begin page -->
    <div class="wrapper mm-show">

        @include('layout_backend.sidebar')

        <div class="content-page">
            <div class="content">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">
{{--                                {{$title}}--}}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Footer Start -->
        @include('layout_backend.footer')
        <!-- end Footer -->

        </div> <!-- content-page -->

    </div> <!-- end wrapper-->
</div>
<!-- END Container -->

<!-- bundle -->
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
</body>
</html>
