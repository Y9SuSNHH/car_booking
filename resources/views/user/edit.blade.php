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
                    <div id="div-error-update" class="alert alert-danger d-none">
                        <ul id="error-update">
                        </ul>
                    </div>
                    <form action="{{ route('api.users.update',auth()->user()->id)}}" method="POST"
                          enctype="multipart/form-data"
                          class="settings-form" id="form-edit">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" id="name" name="name" class="form-control border-input"
                                           value="{{auth()->user()->name}}">
                                </div>
                            </div>
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
                                                       id="gender-male" value="1"
                                                       @if($user->gender === 1)
                                                           checked
                                                    @endif>
                                                Nam
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="col-5 mr-auto form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="gender-female" value="0"
                                                       @if($user->gender === 0)
                                                           checked
                                                    @endif>
                                                Nữ
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <input type="file" name="files[IDENTITY_FRONT]" class="form-control-file"
                                           oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-md-6">
                                    <img id="pic2" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="files[IDENTITY_BACK]" class="form-control-file"
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
                                        <div class="col-md-6">
                                            <h6>Mặt trước</h6>
                                            <img name="ole_license_car_front"
                                                 src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @elseif($file->type === App\Enums\FileTypeEnum::LICENSE_CAR_BACK)
                                        <div class="col-md-6">
                                            <h6>Mặt sau</h6>
                                            <img name="ole_license_car_back" src="{{asset('storage').'/'. $file->link}}"
                                                 style="max-height: 250px; max-width: 250px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <label>Đổi ảnh mới</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <img id="pic3" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="files[LICENSE_CAR_FRONT]" class="form-control-file"
                                           oninput="pic3.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-md-6">
                                    <img id="pic4" style="max-width: 200px; max-height:200px;"/>
                                    <input type="file" name="files[LICENSE_CAR_BACK]" class="form-control-file"
                                           oninput="pic4.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-wd btn-info btn-round">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script type="text/javascript">
        function showError(errors) {
            let string = '<ul>';
            if (Array.isArray(errors)) {
                errors.forEach(function (each) {
                    each.forEach(function (error) {
                        string += `<li>${error}</li>`;
                    });
                });
            } else {
                string += `<li>${errors}</li>`;
            }
            string += '</ul>';
            $("#error-update").html(string);
            $("#div-error-update").removeClass("d-none").show();
        }

        function submitForm() {
            const obj = $("#form-edit");
            const formData = new FormData(obj[0]);
            $.ajax({
                url: obj.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function () {
                    notifySuccess('Sửa thông tin thành công');
                    setTimeout("window.location=`{{route('user.edit')}}`", 3000);
                },
                error: function (response) {
                    let errors;
                    if (response.responseJSON.errors) {
                        errors = Object.values(response.responseJSON.errors);
                        showError(errors);
                    } else {
                        errors = response.responseJSON.message;
                        showError(errors);
                    }
                },
            });
        }

        $(document).ready(async function () {
            $("#form-edit").validate({
                submitHandler: function () {
                    submitForm();
                }
            });
        });
    </script>
@endpush

