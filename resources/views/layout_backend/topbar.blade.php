<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a href="index.html" class="topnav-logo">
                    <span class="topnav-logo-lg">
                        <img src="" alt="" height="16">
                    </span>
            <span class="topnav-logo-sm">
                        <img src="" alt="" height="16">
                    </span>
        </a>

        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li class="notification-list">
                <a class="nav-link right-bar-toggle" href="javascript: void(0);">
                    <i class="dripicons-gear noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="account-user-avatar">
                                <i class="mdi mdi-24px mdi-account"></i>
                            </span>
                    <span>
                                <span class="account-user-name">{{ucwords(auth()->user()->name)}}</span>
                                <span class="account-position">{{auth()->user()->RoleName}}</span>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('signout') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout mr-1"></i>
                        <span>Đăng xuất</span>
                    </a>

                </div>
            </li>

        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
</div>

