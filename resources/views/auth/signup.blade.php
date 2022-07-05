<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đăng kí | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="light-style"
          disabled="disabled">
    <link href="{{asset('css/app-modern-dark.min.css')}}" rel="stylesheet" type="text/css" id="light-style">

</head>

<body class="authentication-bg" data-layout-config="{&quot;darkMode&quot;:false}">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mb-3">Wizard With Progress Bar</h4>

                        <form action="{{route('process_signup')}}" method="post">
                            <div id="progressbarwizard">

                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                    <li class="nav-item">
                                        <a href="#account-2" data-toggle="tab"
                                           class="nav-link rounded-0 pt-2 pb-2 active">
                                            <i class="mdi mdi-account-circle mr-1"></i>
                                            <span class="d-none d-sm-inline">Account</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-tab-2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-face-profile mr-1"></i>
                                            <span class="d-none d-sm-inline">Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#finish-2" data-toggle="tab" id="active-submit"
                                           class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                            <span class="d-none d-sm-inline">Finish</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content b-0 mb-0">

                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                        <div
                                            class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"
                                            style="width: 33.3333%;"></div>
                                    </div>
                                    <div class="tab-pane active" id="account-2">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                @auth
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="name">Họ và
                                                            tên</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name"
                                                                   value="{{auth()->user()->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="email">Email</label>
                                                        <div class="col-md-9">
                                                            <input type="email" id="email" name="email"
                                                                   class="form-control"
                                                                   value="{{auth()->user()->email}}">
                                                        </div>
                                                    </div>
                                                @endauth
                                                @guest
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="name">Họ và
                                                            tên</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="email">Email</label>
                                                        <div class="col-md-9">
                                                            <input type="email" id="email" name="email"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                @endguest
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="password">Mật
                                                        khẩu</label>
                                                    <div class="col-md-9">
                                                        <input type="password" id="password" name="password"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="gender">Giới
                                                        tính</label>
                                                    <br><br><br>
                                                    <div class="col-md-9">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="genderNam" name="gender"
                                                                   class="custom-control-input"
                                                                   value="1" checked>
                                                            <label class="custom-control-label"
                                                                   for="genderNam">Nam</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="genderNữ" name="gender"
                                                                   class="custom-control-input"
                                                                   value="0">
                                                            <label class="custom-control-label"
                                                                   for="genderNữ">Nữ</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="profile-tab-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="phone">Số điện
                                                        thoại</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="phone" name="phone" class="form-control"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label"
                                                           for="address">Quận/Huyện</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="address" name="address"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label"
                                                           for="address2">Tỉnh/TP</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="address2" name="address2"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <div class="tab-pane" id="finish-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                    <h3 class="mt-0">Thank you !</h3>

                                                    <p class="w-75 mb-2 mx-auto">Chúc ban có những chuyến đi thoải mái
                                                        và an toàn</p>

                                                    <div class="mb-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="customCheck3" onclick="greet()">
                                                            <label class="custom-control-label" for="customCheck3">Tôi
                                                                đồng ý với các điều khoản và điều kiện</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <ul class="list-inline mb-0 wizard">
                                        <li class="previous list-inline-item disabled">
                                            <a href="#" class="btn btn-info">Trước</a>
                                        </li>
                                        <li class="next list-inline-item float-right">
                                            <button type="submit" class="btn btn-info" id="btnvis" style="visibility: hidden;">Đăng kí</button>
                                            <a href="#" class="btn btn-info" id="a" style="visibility: visible;">
                                                <span id="submit">Tiếp</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div> <!-- tab-content -->
                            </div> <!-- end #progressbarwizard-->
                        </form>

                    </div> <!-- end card-body -->
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Nếu bạn đã có tài khoản hãy - <a href="{{route('signin')}}"
                                                                               class="text-muted ml-1"><b>Đăng nhập</b></a>
                        </p>
                    </div> <!-- end col-->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    {{--    2018 - 2020 © Hyper - Coderthemes.com--}}
</footer>

<!-- bundle -->
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.form-wizard.js')}}"></script>
<script text="javascript">
    const active = document.getElementById("active-submit");
    function greet() {
        if (active.classList.contains('active') && document.getElementById('customCheck3').checked) {
            document.getElementById("btnvis").style.visibility = 'visible';
            document.getElementById("btnvis").style.display = 'block';
            document.getElementById("a").style.visibility = 'hidden';
            document.getElementById("a").style.display = 'none';
        } else {
            document.getElementById("btnvis").style.visibility = 'hidden';
            document.getElementById("btnvis").style.display = 'none';
            document.getElementById("a").style.visibility = 'visible';
            document.getElementById("a").style.display = 'block';
        }
    }


</script>
</body>
</html>

