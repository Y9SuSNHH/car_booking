@extends('layout_frontend.master')
@push('css')
    <style>
        .popImage {
            height: 200px !important;
        }
    </style>
@endpush
@section('content')
    <div class="page-header page-header-small"
         style="background-image: url('https://images.unsplash.com/photo-1486310662856-32058c639c65?dpr=2&auto=format&fit=crop&w=1500&h=1125&q=80&cs=tinysrgb&crop=');">
        <div class="filter"></div>
    </div>
    <div class="profile-content section">
        <div class="container">
            <div class="row">
                <div class="profile-picture">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-no-padding text-center">
                            <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745"
                                 alt="...">
                        </div>
                        <div class="name">
                            <h4 class="title text-center font-weight-bold">
                                {{auth()->user()->name}}
                                <br>
                                <small>
                                    Giới tính: {{auth()->user()->gender ? 'Nam' : 'Nữ'}}
                                    <br>
                                    Địa chỉ : {{auth()->user()->address2}} - {{auth()->user()->address}}
                                    @if(!empty(auth()->user()->address) && !empty(auth()->user()->address))
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="Chưa điền đủ địa chỉ"></i>
                                    @endif
                                    <br>
                                    Số điện thoại: {{auth()->user()->phone}}
                                    @if(empty(auth()->user()->phone))
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="Chưa điền sđt"></i>
                                    @endif
                                    <br>
                                    Ngày thêm: {{date('d-m-Y', strtotime(auth()->user()->created_at))}}
                                    <br>
                                    <a href="{{route("user.edit")}}" class="btn btn-just-icon btn-border btn-twitter">
                                        <i class="mdi mdi-account-edit mdi-18px p-0"></i>
                                    </a>
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-md-8 ml-auto mr-auto text-center">
                                <h4 class="title font-weight-bold">CCCD
                                    <i class="mdi mdi-eye-outline" id="identity"></i>
                                    @if(count($user['identity']['link']) !== 2)
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="CCCD chưa điền"></i>
                                    @endif
                                    @if($user['identity']['status'] !== 2)
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="CCCD Chưa được duyệt"></i>
                                    @endif
                                </h4>
                            </div>
                            <div class="row">
                                @if(count($user['identity']['link']) === 2)
                                    <div class="col-md-6">
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{$user['identity']['link']['IDENTITY_FRONT']}}')">
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{$user['identity']['link']['IDENTITY_BACK']}}')">
                                            <div class="card-body identity">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-8 ml-auto mr-auto text-center">
                                <h4 class="title font-weight-bold">GPLX
                                    <i class="mdi mdi-eye-outline" id="license-car"></i>
                                    @if(count($user['license_car']['link']) !== 2)
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="Chưa điền GPLX"></i>
                                    @endif
                                    @if($user['license_car']['status'] !== 2)
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="GPLX chưa được duyệt"></i>
                                    @endif
                                </h4>
                            </div>
                            <div class="row">
                                @if(count($user['license_car']['link']) === 2)
                                    <div class="col-md-6">
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{$user['license_car']['link']['LICENSE_CAR_FRONT']}}')"
                                        >
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{$user['license_car']['link']['LICENSE_CAR_BACK']}}')">
                                            <div class="card-body license-car">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" data-dismiss="modal">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <img src="" class="imagepreview" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').addClass('profile');
            $(function () {
                $('.popImage').on('click', function () {
                    // bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
                    let bg = $(this).css("background-image")
                    // bg = bg.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '')
                    console.log(bg);
                    // $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                    // $('#imagemodal').modal('show');
                });
            });
        });
    </script>
@endpush
