<nav class="navbar navbar-expand-lg fixed-top p-0" data-background-color="black">
    <div class="container">
        <div class="navbar-translate">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#example-navbar-primary" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}"><h5>KEVINOTO</h5></a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-primary"
             data-nav-image="./assets/img/blurred-image-1.jpg">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact Us
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>
                                {{auth()->user()->name}}
                            </p>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a href="{{ route('signout') }}" class="dropdown-item">
                                <i class="mdi mdi-logout mr-1"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('signin')}}">
                            Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('signup')}}">
                            Đăng kí
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
