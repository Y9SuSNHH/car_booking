<nav class="navbar navbar-expand-lg fixed-top nav-down bg-dark">
    <div class="container">
        <div class="navbar-translate">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('welcome')}}">{{ config('app.name') }}</a>
            </div>
            <button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse"
                    data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('welcome')}}" data-scroll="true">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        Contact Us
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                           data-toggle="dropdown"><i class="nc-icon nc-single-02"></i> {{auth()->user()->name}}</a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-danger">
                            <a class="dropdown-item" href="{{route('signout')}}">
                                <i class="mdi mdi-logout mr-1"></i>
                                Đăng xuất
                            </a>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('signin')}}" data-scroll="true">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('signup')}}" data-scroll="true">Đăng kí</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
