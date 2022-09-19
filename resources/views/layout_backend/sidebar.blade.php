<div class="left-side-menu left-side-menu-detached">
    <div class="leftbar-user">
        {{--            <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">--}}
        <i class="mdi mdi-24px mdi-account"></i>
        <span class="leftbar-user-name">{{ucwords(auth()->user()->name)}}</span>
        {{--        </a>--}}
    </div>
    <ul class="metismenu side-nav">
        <li class="side-nav-item">
            <a href="{{ route('admin.users.index') }}" class="side-nav-link">
                <i class="uil uil-user"></i>
                <span class="badge badge-info badge-pill float-right"></span>
                <span>Quản lý người dùng </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{ route('admin.cars.index') }}" class="side-nav-link">
                <i class="mdi mdi-car"></i>
                <span class="badge badge-info badge-pill float-right"></span>
                <span> Quản lý xe </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="uil uil-bill"></i>
                <span class="badge badge-info badge-pill float-right"></span>
                <span> Quản lý hóa đơn </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level mm-collapse" aria-expanded="false" style="height: 0px;">
                <li>
                    <a href="{{ route('admin.bills.index') }}">Danh sách hoá đơn</a>
                </li>
                <li>
                    <a href="{{ route('admin.bills.find.cars')}}">Tạo hoá đơn</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
