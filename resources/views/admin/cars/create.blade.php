@extends('layout_backend.master')
@push('css')
    <style>
        .error {
            color: red !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="div-error" class="alert alert-danger d-none"></div>
                <div class="card-body" >
                    <form action="{{ route('admin.cars.store') }}" id="form-create" method="POST"
                          enctype="multipart/form-data"
                          class="form-horizontal" data-plugin="dropzone"
                          data-previews-container="#file-previews"
                          data-upload-preview-template="#uploadPreviewTemplate">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">Tên xe</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group select-location col-3">
                                <label for="select-address">Tỉnh/TP</label>
                                <select class="form-control select-address" name="address" id='select-address'></select>
                            </div>
                            <div class="form-group select-location col-3">
                                <label for="select-address2">Quận/Huyện</label>
                                <select class="form-control select-address2" name="address2"
                                        id='select-address2'></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="type">Loại xe</label>
                                <select name="type" id="type" class="form-control select-filter">
                                    @foreach($types as $key => $value)
                                        <option value="{{ $key }}"
                                                @if ($loop->first)
                                                    selected
                                            @endif>
                                            {{ $value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="slot">Số ghế ngồi</label>
                                <select name="slot" id="slot" class="form-control">
                                    <option value="4">4 chỗ</option>
                                    <option value="5">5 chỗ</option>
                                    <option value="7">7 chỗ</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="transmission">Truyền động</label>
                                <select name="transmission" id="transmission" class="form-control">
                                    <option value="0">Số tự động</option>
                                    <option value="1">Số sàn</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="fuel">Nhiên liệu</label>
                                <select name="fuel" id="fuel" class="form-control">
                                    <option value="0">Xăng</option>
                                    <option value="1">Dầu</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="fuel_comsumpiton">Mức tiêu thụ nhiên liệu (L/km)</label>
                                <input type="number" name="fuel_comsumpiton" id="fuel_comsumpiton" class="form-control"
                                       placeholder="L/km">
                            </div>
                            <div class="form-group col-4">
                                <label for="car-status">Trạng thái</label>
                                <select class="form-control select-filter" name="status" id="car-status">
                                    @foreach($status as $key => $value)
                                        <option value="{{ $key }}"
                                                @if ($loop->first)
                                                    selected
                                            @endif>
                                            {{ $value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <div class="form-group">
                                    <label for="photo">Ảnh</label>
                                    <img id="pic" style="max-width: 300px; max-height:200px;"/>
                                    <input type="file" name="photo" id="photo" class="form-control-file"
                                           oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="form-group">
                                    <label for="fullphoto">Ảnh chi tiết</label>
                                    <input type="file" name="fullphoto[]" id="fullphoto" class="form-control-file"
                                           multiple onchange="preview_image();">
                                    <div id="image_preview"></div>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả </label>
                                    <textarea class="form-control" placeholder="Nhập mô tả ở đây.."
                                              name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-group">
                                    <label for="price_1_day">Giá thuê 1 ngày</label>
                                    <input type="number" name="price_1_day" id="price_1_day" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="price_insure">Phí bảo hiểm</label>
                                    <input type="number" name="price_insure" id="price_insure" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="price_service">Phí dịch vụ</label>
                                    <input type="number" name="price_service" id="price_service" class="form-control">
                                </div>
                                <div class="form-group float-right">
                                    <button class="btn btn-success" id="btn-submit">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/pages/demo.toastr.js')}}"></script>
    <script type="text/javascript">
        async function loadDistrict(parent) {
            $("#select-address2").empty();
            const path = $("#select-address option:selected").data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            const address2 = await response.json();
            $.each(address2.district, function (index, each) {
                $("#select-address2").append(`
                        <option>
                            ${each.pre} ${each.name}
                        </option>`);
            })
        }

        function generateSlug(name) {
            $.ajax({
                url: '{{ route('api.cars.slug.generate') }}',
                type: 'POST',
                dataType: 'json',
                data: {name},
                success: function (response) {
                    $("#slug").val(response.data);
                    $("#slug").trigger("change");
                },
                error: function (response) {
                }
            });
        }

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
            $("#div-error").html(string);
            $("#div-error").removeClass("d-none").show();
        }

        function preview_image() {
            var total_file = document.getElementById("fullphoto").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' style='max-width: 300px; max-height:200px;'>");
            }
        }

        function submitForm() {
            const obj = $("#form-create");
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
                success: function (response) {
                    if (response.success) {
                        $("#div-error").hide();
                        notifySuccess('Thêm xe mới');
                        $("#image_preview").empty();
                        obj[0].reset();
                    } else {
                        showError(response.message);
                    }
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
            $("#select-address").select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            $.each(address, function (index, each) {
                $("#select-address").append(`
                <option value='${index}' data-path='${each.file_path}'>
                    ${index}
                </option>`);
            })

            $("#select-address").change(function () {
                loadDistrict();
            });
            $("#select-address2").select2();
            await loadDistrict();

            $(document).on('change', '#name', function () {
                const name = $("#name").val();
                generateSlug(name);
            })

            $("#slug").change(function () {
                $("#btn-submit").attr('disabled', true);
                $.ajax({
                    url: '{{ route('api.cars.slug.check') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {slug: $(this).val()},
                    success: function (response) {
                        if (response.success) {
                            $("#btn-submit").attr('disabled', false);
                        }
                    }
                });
            })

            $("#form-create").validate({
                rules: {
                    name: {
                        required: true
                    }
                },
                submitHandler: function () {
                    submitForm();
                }
            });
        });
    </script>
@endpush

