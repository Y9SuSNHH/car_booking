@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data"
                          class="form-horizontal" id="form-create-post" data-plugin="dropzone" data-previews-container="#file-previews"
                          data-upload-preview-template="#uploadPreviewTemplate">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">Tên xe</label>
                                <input type="text" name="name" id="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group select-location col-6">
                                <label for="select-address">Địa chỉ</label>
                                <select class="form-control select-address" name="address" id='select-address'></select>
                                @if ($errors->has('address'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('address') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="photo">Ảnh</label>
                                <input type="file" name="photo" id="photo" class="form-control-file">
                                @if ($errors->has('image'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('image') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label for="type">Loại xe</label>
                                <select name="type" id="type" class="form-control select-filter">
                                    @foreach($types as $key => $value)
                                        <option value="{{ $value }}"
                                                @if ($loop->first)
                                                selected
                                            @endif>
                                            {{ $key}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('type') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label for="slot">Số ghế ngồi</label>
                                <select name="slot" id="slot" class="form-control">
                                    <option value="4">4 chỗ</option>
                                    <option value="5">5 chỗ</option>
                                    <option value="7">7 chỗ</option>
                                </select>
                                @if ($errors->has('slot'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('slot') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="transmission">Truyền động</label>
                                <select name="transmission" id="transmission" class="form-control">
                                    <option value="0">Số tự động</option>
                                    <option value="1">Số sàn</option>
                                </select>
                                @if ($errors->has('transmission'))
                                    <span class="valid-feedback">
                                         {{ $errors->first('transmission') }}
                                     </span>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label for="fuel">Nhiên liệu</label>
                                <select name="fuel" id="fuel" class="form-control">
                                    <option value="0">Xăng</option>
                                    <option value="1">Dầu</option>
                                </select>
                                @if ($errors->has('fuel'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('fuel') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label for="fuel_comsumpiton">Mức tiêu thụ nhiên liệu</label>
                                <input type="number" name="fuel_comsumpiton" id="fuel_comsumpiton" class="form-control"
                                       placeholder="L/km">
                                @if ($errors->has('fuel_comsumpiton'))
                                    <span class="valid-feedback">
                                        {{ $errors->first('fuel_comsumpiton') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="car-status">Trạng thái</label>
                                <select class="form-control select-filter" name="status" id="car-status">
                                    @foreach($status as $key => $value)
                                        <option value="{{ $value }}"
                                                @if ($loop->first)
                                                selected
                                            @endif>
                                            {{ $key}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <span class="valid-feedback">
                                            {{ $errors->first('status') }}
                                        </span>
                                @endif
                                <br>
                                <br>
                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                    <div class="dz-message needsclick">
                                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                                        <h3>Drop files here or click to upload.</h3>
                                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                                    <strong>not</strong> actually uploaded.)</span>
                                    </div>
                                </div>

                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                                </div>
                                                <div class="col pl-0">
                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                        <i class="dripicons-cross"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success">Thêm</button>
                            </div>
                            <div class="form-group col-6">
                                <div class="form-row">
                                    <label for="car-price_1_day">Giá thuê 1 ngày</label>
                                    <input type="number" name="price_1_day" id="price_1_day" class="form-control">
                                    @if ($errors->has('price_1_day'))
                                        <span class="valid-feedback">
                                        {{ $errors->first('price_1_day') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <label for="car-price_insure">Phí bảo hiểm</label>
                                    <input type="number" name="price_insure" id="price_insure" class="form-control">
                                    @if ($errors->has('price_insure'))
                                        <span class="valid-feedback">
                                         {{ $errors->first('price_insure') }}
                                     </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <label for="car-price_service">Phí dịch vụ</label>
                                    <input type="number" name="price_service" id="price_service" class="form-control">
                                    @if ($errors->has('price_service'))
                                        <span class="valid-feedback">
                                        {{ $errors->first('price_service') }}
                                    </span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-row">
                                    <label for="description">Mô tả </label>
                                    <textarea class="form-control" placeholder="Nhập mô tả ở đây.."
                                              name="description" id="description"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="valid-feedback">
                                            {{ $errors->first('description') }}
                                        </span>
                                    @endif
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
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/component.fileupload.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(async function () {
            $("#select-city").select2({tags: true});
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            // console.log(address);
            $.each(address, function (index, each) {
                $("#select-address").append(`
                <option value='${each.code}' data-path='${each.file_path}}'>
                    ${index}
                </option>`)
            })
            {{--$("#select-name").select2({--}}
            {{--    tag: true,--}}
            {{--    ajax: {--}}
            {{--        url: '{{route('api.cars')}}',--}}
            {{--        data: function (params) {--}}
            {{--            var queryParameters = {--}}
            {{--                q: params.term--}}
            {{--            }--}}

            {{--            return queryParameters;--}}
            {{--        },--}}
            {{--        processResults: function (data) {--}}
            {{--            return {--}}
            {{--                results: $.map(data.data, function (item) {--}}
            {{--                    return {--}}
            {{--                        text: item.name,--}}
            {{--                        id: item.id--}}
            {{--                    }--}}
            {{--                })--}}
            {{--            };--}}
            {{--        }--}}
            {{--    },--}}
            {{--});--}}
        });
    </script>
@endpush

