@extends('layout_backend.master')
@push('css')
    <style>
        input[data-switch]:checked + label:after {
            left: 78px;
        }

        input[data-switch] + label {
            width: 100px;
        }
    </style>
@endpush
@section('breadcrumbs')
    {{ Breadcrumbs::render('user.edit') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('api.users.update', $user->id )}}" method="post"
                          enctype="multipart/form-data"
                          class="form-group" id="form-edit">
                        @method('PUT')
                        @csrf
                        <div id="div-error" class="alert alert-danger d-none"></div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="name">Tên xe</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="phone">Số điện thoại</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                       value="{{$user->phone}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Giới tinh</label>
                                <div class="mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gender-male" name="gender"
                                               class="custom-control-input" value="1"
                                               @if($user->gender === 1)
                                                   checked
                                            @endif>
                                        <label class="custom-control-label" for="gender-male">Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gender-female" name="gender"
                                               class="custom-control-input" value="0"
                                               @if($user->gender === 0)
                                                   checked
                                            @endif>
                                        <label class="custom-control-label" for="gender-female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            @if (!$checkUserIdentity)
                                <div class="form-group col-xl-6">
                                    <label>GPLX</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6>Mặt trước</h6>
                                            <input type="file" name="files[IDENTITY_FRONT]" class="form-control-file"
                                                   oninput="pic1.src=window.URL.createObjectURL(this.files[0])">
                                            <img id="pic1" style="max-width: 200px; max-height:200px;"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Mặt sau</h6>
                                            <input type="file" name="files[IDENTITY_BACK]" class="form-control-file"
                                                   oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                                            <img id="pic2" style="max-width: 200px; max-height:200px;"/>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!$checkUserLicenseCar)
                                <div class="form-group col-xl-6">
                                    <label>GPLX</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6>Mặt trước</h6>
                                            <input type="file" name="files[LICENSE_CAR_FRONT]"
                                                   class="form-control-file"
                                                   oninput="pic3.src=window.URL.createObjectURL(this.files[0])">
                                            <img id="pic3" style="max-width: 200px; max-height:200px;"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Mặt sau</h6>
                                            <input type="file" name="files[LICENSE_CAR_BACK]" class="form-control-file"
                                                   oninput="pic4.src=window.URL.createObjectURL(this.files[0])">
                                            <img id="pic4" style="max-width: 200px; max-height:200px;"/>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-row">
                            <button class="btn btn-info">Cập nhật</button>
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
        function submitForm() {
            const form = $("#form-edit");
            form.on('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    success: function () {
                        notifySuccess('Sửa thành công');
                    },
                    error: function () {
                        notifyError('Sửa thất bại');
                    },
                });
            });
        }

        $(document).ready(async function () {
            submitForm();
        });
    </script>
@endpush
