@extends('layout_frontend.master')
@section('content')
    <div class="profile-content section">
        <div class="container">
            <div class="row">
                <div class="profile-picture">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-no-padding text-center">
                            <img src="{{asset('storage/configs/icon-256x256.png')}}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-no-padding"></div>
                        <div class="name">
                            <h4 class="title text-center font-weight-bold">
                                {{auth()->user()->name}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <form action="{{ route('user.update')}}" method="POST" enctype="multipart/form-data"
                          class="settings-form">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" class="form-control border-input"
                                   value="{{auth()->user()->name}}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Số điện thoại</label>
                                    <input type="number" name="phone" class="form-control border-input"
                                           value="{{auth()->user()->phone}}">
                                </div>
                                <div class="col-md-6">
                                    <label>Giới tính</label>
                                    <div class="row">
                                        <div class="col-5 ml-auto form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="gender-male"
                                                       value="1"
                                                       checked>
                                                Nam
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="col-5 mr-auto form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="gender-female"
                                                       value="0">
                                                Nữ
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="select-address">Tỉnh/TP</label>
                                    <select class="form-control select-address" name="address"
                                            id='select-address'></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="select-address2">Quận/Huyện</label>
                                    <select class="form-control select-address2" name="address2"
                                            id='select-address2'></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control border-input"
                                   value="{{auth()->user()->email}}">
                        </div>
                        <div class="form-group text-center">
                            <label for="">CCCD</label>
                            <br>
                            <label>Ảnh cũ</label>
                            <div class="row">
                                <br>
                                @foreach($user->files as $file)
                                    @if($file->type === App\Enums\FileTypeEnum::IDENTITY_FRONT)
                                        <div class="col-md-6">
                                            <h6>Mặt trước</h6>
                                            <img name="ole_identity_front" src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @elseif($file->type === App\Enums\FileTypeEnum::IDENTITY_BACK)
                                        <div class="col-md-6">
                                            <h6>Mặt sau</h6>
                                            <img name="ole_identity_back" src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <label>Đổi ảnh mới</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <img id="pic1" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="identity_front" class="form-control-file"
                                           oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-md-6">
                                    <img id="pic2" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="identity_back" class="form-control-file"
                                           oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="">GPLX</label>
                            <br>
                            <label>Ảnh cũ</label>
                            <div class="row">
                                <br>
                                @foreach($user->files as $file)
                                    @if($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_FRONT)
                                        <div class="col-md-6 text-center">
                                            <img name="ole_license_car_front" src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @elseif($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_BACK)
                                        <div class="col-md-6">
                                            <img name="ole_license_car_back" src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <label>Đổi ảnh mới</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Mặt trước</h6>
                                    <img id="pic3" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="license_car_front" class="form-control-file"
                                           oninput="pic3.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-md-6">
                                    <h6>Mặt sau</h6>
                                    <img id="pic4" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="license_car_back" class="form-control-file"
                                           oninput="pic4.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-wd btn-info btn-round">Thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{asset('js/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/pages/demo.toastr.js')}}"></script>
    <script type="text/javascript">
        async function loadDistrict(parent) {
            $("#select-address2").empty();
            const path = $("#select-address option:selected").data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            const address2 = await response.json();
            const district = "{{$user->address2}}";
            $.each(address2.district, function (index, each) {
                let selected = '';
                let select = each.pre + ' ' + each.name;
                if (district === select) {
                    selected = 'selected';
                }
                $("#select-address2").append(`
                        <option ${selected}>
                            ${each.pre} ${each.name}
                        </option>`);
            })
        }
        function UserUpdate() {
            @if (session('UserUpdate'))
            notifyInfo(`{{session('UserUpdate')}}`);
            @endif
        }

        $(document).ready(async function () {
            UserUpdate();

            $("#select-address").select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            const city = "{{$user->address}}";
            $.each(address, function (index, each) {
                let selected = '';
                if (city === index) {
                    selected = 'selected';
                }
                $("#select-address").append(`
                <option value='${index}' data-path='${each.file_path}' ${selected}>
                    ${index}
                </option>`);
            })

            $("#select-address").change(function () {
                loadDistrict();
            });
            $("#select-address2").select2();
            await loadDistrict();
        });
    </script>
@endpush

