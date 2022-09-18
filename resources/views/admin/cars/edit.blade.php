@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cars.update', $each )}}" method="POST" enctype="multipart/form-data"
                          class="form-group">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">Tên xe</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$each->name}}">
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
                                                @if ($key===$each->type)
                                                    selected
                                            @endif>{{ $value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="slot">Số ghế ngồi</label>
                                <select name="slot" id="slot" class="form-control">
                                    @foreach($slots as $value)
                                        <option value="{{ $value }}"
                                                @if ($value===$each->slot)
                                                    selected
                                            @endif>{{$value}} chỗ
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="transmission">Truyền động</label>
                                <select name="transmission" id="transmission" class="form-control">
                                    <option value="0"
                                            @if (0===$each->transmission)
                                                selected
                                        @endif>Số tự động
                                    </option>
                                    <option value="1"
                                            @if (1===$each->transmission)
                                                selected
                                        @endif>Số sàn
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="fuel">Nhiên liệu</label>
                                <select name="fuel" id="fuel" class="form-control">
                                    <option value="0"
                                            @if (0===$each->transmission)
                                                selected
                                        @endif>Xăng
                                    </option>
                                    <option value="1"
                                            @if (1===$each->transmission)
                                                selected
                                        @endif>Dầu
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="fuel_comsumpiton">Mức tiêu thụ nhiên liệu (L/km)</label>
                                <input type="number" name="fuel_comsumpiton" id="fuel_comsumpiton" class="form-control"
                                       placeholder="L/km" value="{{$each->fuel_comsumpiton}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="car-status">Trạng thái</label>
                                <select class="form-control select-filter" name="status" id="car-status">
                                    @foreach($status as $key => $value)
                                        <option value="{{ $key }}"
                                                @if ($key === $each->status)
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
                                    <label>Ảnh cũ</label>
                                    <img name="ole_image" src="{{asset('storage'). '/'. $each->image}}" alt="ảnh cũ"
                                         style="max-width: 200px; max-height:200px;">
                                    <br>
                                    <label for="photo">Thay ảnh mới</label>
                                    <img id="pic" style="max-width: 200px; max-height:200px;" src=""/>
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
                                    <input type="text" name="slug" id="slug" class="form-control"
                                           value="{{$each->slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" placeholder="Nhập mô tả ở đây.."
                                              name="description" id="description"
                                              style="height: 300px;">{{$each->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-group">
                                    <label for="price_1_day">Giá thuê 1 ngày</label>
                                    <input type="number" name="price_1_day" id="price_1_day" class="form-control"
                                           value="{{$each->price_1_day}}">
                                </div>
                                <div class="form-group">
                                    <label for="price_insure">Phí bảo hiểm</label>
                                    <input type="number" name="price_insure" id="price_insure" class="form-control"
                                           value="{{$each->price_insure}}">
                                </div>
                                <div class="form-group">
                                    <label for="price_service">Phí dịch vụ</label>
                                    <input type="number" name="price_service" id="price_service" class="form-control"
                                           value="{{$each->price_service}}">
                                </div>
                                <div class="form-group float-right">
                                    <button class="btn btn-info" id="btn-submit">Sửa</button>
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
    <script type="text/javascript">
        async function loadDistrict(parent) {
            $("#select-address2").empty();
            const path = $("#select-address option:selected").data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            const address2 = await response.json();
            const district = "{{$each->address2}}";
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


        function preview_image() {
            var total_file = document.getElementById("fullphoto").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' style='max-width: 300px; max-height:200px;'>");
            }
        }

        $(document).ready(async function () {
            $("#select-address").select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            const city = "{{$each->address}}";
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

        });
    </script>
@endpush
