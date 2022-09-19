@extends('layout_frontend.master')
@push('css')
    <style>
        .popImage {
            height: 200px !important;
        }
    </style>
@endpush
@section('content')
    <div class="page-header page-header-xs"
         style="background-image: url('https://images.unsplash.com/photo-1486310662856-32058c639c65?dpr=2&auto=format&fit=crop&w=1500&h=1125&q=80&cs=tinysrgb&crop=');">
        <div class="filter"></div>
    </div>
    <div class="profile-content section">
        <div class="container">
            <div class="row">
                <div class="profile-picture">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-no-padding text-center">
                            <img src="{{asset('storage/configs/icon-256x256.png')}}"
                                 alt="...">
                        </div>
                        <div class="name">
                            <h4 class="title text-center font-weight-bold">
                                {{$user->name}}
                                <br>
                                <small>
                                    Giới tính: {{$user->gender ? 'Nam' : 'Nữ'}}
                                    <br>
                                    Địa chỉ : {{$user->address2}} - {{$user->address}}
                                    @if(empty($user->address2) || empty($user->address))
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="Chưa điền đủ địa chỉ"></i>
                                    @endif
                                    <br>
                                    Số điện thoại: {{$user->phone}}
                                    @if(empty($user->phone))
                                        <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                           data-placement="top" title="Chưa điền sđt"></i>
                                    @endif
                                    <br>
                                    Ngày tham gia: {{date('d-m-Y', strtotime($user->created_at))}}
                                    <br>
                                    <a href="{{route("user.edit")}}"
                                       class="btn btn-just-icon btn-border btn-twitter">
                                        <i class="mdi mdi-account-edit mdi-18px p-0"></i>
                                    </a>
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h4 class="title font-weight-bold">CCCD
                                <i class="mdi mdi-eye-outline" id="identity"></i>
                                @if($user->FileIdentity !== 'success')
                                    <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                       data-placement="top" title="CCCD chưa điền/duyệt"></i>
                                @endif
                            </h4>
                        </div>
                        <div class="row">
                            @foreach ($user->files as $file)
                                @if($file->type === App\Enums\FileTypeEnum::IDENTITY_FRONT || $file->type === App\Enums\FileTypeEnum::IDENTITY_BACK)
                                    <div class="col-md-6">
{{--                                        <img src="{{asset('storage/').'/'. $file->link}}" class="img-rounded img-responsive">--}}
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{asset('storage/').'/'. $file->link}}')">
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h4 class="title font-weight-bold">GPLX
                                <i class="mdi mdi-eye-outline" id="license-car"></i>
                                @if($user->FileLicenseCar !== 'success')
                                    <i class="mdi dripicons-warning text-danger mdi-18px" data-toggle="tooltip"
                                       data-placement="top" title="GPLX chưa điền/duyệt"></i>
                                @endif
                            </h4>
                        </div>
                        <div class="row">
                            @foreach ($user->files as $file)
                                @if($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_FRONT || $file->type === App\Enums\FileTypeEnum::LICENSE_CAR_BACK)
                                    <div class="col-md-6">
                                        <div class="card popImage" data-background="image"
                                             style="background-image: url('{{asset('storage').'/'. $file->link}}')">
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
        $('body').addClass('profile');
    </script>
@endpush
