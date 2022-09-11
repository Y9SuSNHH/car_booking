{{--đăng nhập cùng--}}
{{--<a href="{{route('auth.redirect','github')}}">github</a>--}}
{{--<a href="{{route('auth.redirect','google')}}">google</a>--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập | {{config('app.name')}}</title>
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

<body class="authentication-bg" data-layout-config="{&quot;darkMode&quot;:false}">
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">

                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="#">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>
                    <div class="card-body p-4">
                        @if (session()->has('failed'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session()->get('failed') }}
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('process_signin')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input class="form-control" type="email" id="emailaddress" required=""
                                       placeholder="Điền email tại đây" name="email" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <a href="pages-recoverpw.html" class="text-muted float-right"><small>Forgot your
                                        password?</small></a>
                                <label for="password">Mật khẩu</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                           placeholder="Điền mật khẩu tại đây" name="password">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                    <label class="custom-control-label" for="checkbox-signin">Ghi nhớ đăng nhập</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary" type="submit">Đăng nhập</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Đăng nhập bằng</p>
                            <ul class="social-list list-inline mt-3">
                                {{--                                <li class="list-inline-item">--}}
                                {{--                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>--}}
                                {{--                                </li>--}}
                                <li class="list-inline-item">
                                    <a href="{{route('auth.redirect','google')}}"
                                       class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{route('auth.redirect','github')}}"
                                       class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-github-circle"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Nếu bạn chưa có tài khoản hãy -
                            <a href="{{route('signup')}}" class="text-muted ml-1">
                                <b>Đăng kí</b>
                            </a>
                        </p>
                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
</body>
</html>
