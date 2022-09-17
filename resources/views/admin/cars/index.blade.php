@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-4">
                            <form class="form-row" id="form-filter">
                                <div class="form-group col-md-8">
                                    <label for="select-name">Tên xe</label>
                                    <select class="form-control select-filter" name="name" id='select-name'>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="select-status">Trạng thái</label>
                                    <select class="form-control select-filter" name="status" id='select-status'>
                                        <option value="All" selected>Tất cả</option>
                                        @foreach($status as $key => $value)
                                            <option value="{{$key}}"
                                                    @if((string)$key === $search['filter']['status'])
                                                        selected
                                                @endif>
                                                {{$value}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" hidden name="address" value="{{$search['find']['address']}}">
                                <input type="text" hidden name="date_start" value="{{$search['find']['date_start']}}">
                                <input type="text" hidden name="date_end" value="{{$search['find']['date_start']}}">
                            </form>
                        </div>
                        <div class="col-xl-8">
                            <br>
                            <nav class="float-right">
                                <ul class="pagination pagination-rounded mb-0">
                                    {{$data->appends(request()->query())->links()}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="header-title">
                        <div class="form-group col-md-2">
                            <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Thêm xe</a>
                        </div>
                    </div>
                    <div class="tab-content" style="overflow-y: auto !important;">
                        <div class="tab-pane show active" id="responsive-preview">
                            <div class="table-responsive">
                                <table id="table-data" class="table table-striped table-centered mb-0   ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Biển số</th>
                                        <th scope="col">Thông tin xe</th>
                                        <th scope="col">Đặc điểm</th>
                                        <th scope="col">
                                            Giá thuê 1 ngày
                                            <br>
                                            Phí bảo hiểm - dịch vụ
                                            <br>
                                            Ngày thêm
                                        </th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Xử lý</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $each)
                                        <tr>
                                            <td>{{$each->id}}</td>
                                            <td>
                                                <button type="button" id="btn-modal-each-car-{{$each->id}}"
                                                        data-toggle='modal' data-target='#modal-each-car'
                                                        class='btn btn-link btn-rounded'>
                                                    <img src="{{asset("storage/"). $each->image}}"
                                                         class="img-fluid img-thumbnail p-1"
                                                         style="max-width: 300px; max-height:200px;">
                                                </button>
                                            </td>
                                            <td>
                                                {{$each->name}}
                                                <br>
                                                {{$each->address2}} - {{$each->address}}
                                            </td>
                                            <td>
                                                <span class="badge badge-warning-lighten">{{$each->type}} </span>
                                                -
                                                <span class="badge badge-warning-lighten">{{$each->slot}} chỗ</span>
                                                <br>
                                                @if ($each->transmission === 0)
                                                    <span class="badge badge-primary">Số tự động</span>
                                                @else
                                                    <span class="badge badge-info">Số sàn</span>
                                                @endif
                                                <br>
                                                @if ($each->fuel === 0)
                                                    <span class="badge badge-dark-lighten">Dầu - {{$each->fuel_comsumpiton}} L/km</span>
                                                @else
                                                    <span class="badge badge-success-lighten">Xăng - {{$each->fuel_comsumpiton}} L/km</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-success">{{$each->price_1_day}} K</span>
                                                <br>
                                                <span
                                                    class="badge badge-secondary">{{$each->price_insure}}đ - {{$each->price_service}}đ</span>
                                                <br>
                                                <span
                                                    class="badge badge-info">{{date("d-m-Y", strtotime($each->created_at))}}</span>
                                            </td>
                                            <td>
                                                @if ($isFind === 0)
                                                    <button type='button'
                                                            id='btn-modal-form-create-bill-" + each.id + "'
                                                            data-toggle='modal' data-target='#modal-form-create-bill'
                                                            class='btn btn-outline-info'><i class='uil-money-bill'></i>
                                                    </button>
                                                @elseif($isFind === 3)
                                                    @if ($each->status === 0)
                                                        <i class="mdi mdi-circle text-success"></i>
                                                    @else
                                                        <i class="mdi mdi-circle text-warning"></i>
                                                    @endif
                                                    {{$each->StatusName}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="{{route("admin.cars.edit",$each->id)}}" class='action-icon'><i
                                                        class='mdi mdi-pencil'></i></a>
                                                @if(auth()->user()->role === \App\Enums\UserRoleEnum::ADMIN)
                                                    <form action="{{route("admin.cars.destroy",$each->id)}}"
                                                          method="post"
                                                          class="action-icon" style="margin: 0px;padding: 0px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link action-icon"><i
                                                                class='mdi mdi-delete'></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-form-create-bill" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nhập thông tin khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="action-bill-store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="name">Họ và tên</label>
                                <input type="text" class="form-control"
                                       id="name" name="name">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label>Giới tính</label>
                                </div>
                                <div class="row">
                                    <div
                                        class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input"
                                               type="radio"
                                               name="gender"
                                               id="genderMale"
                                               value="1" checked>
                                        <label class="custom-control-label"
                                               for="genderMale">Nam</label>
                                    </div>
                                    <div
                                        class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input"
                                               type="radio"
                                               name="gender"
                                               id="genderFemale"
                                               value="0">
                                        <label class="custom-control-label"
                                               for="genderFemale">Nữ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="phone">Số điện
                                    thoại</label>
                                <input type="number" id="phone" name="phone" class="form-control"
                                       value="">
                            </div>
                            <div class="col">
                                <label for="select-address">Tỉnh/TP</label>
                                <select class="form-control select-address" name="address"
                                        id='select-address'></select>
                            </div>
                            <div class="col">
                                <label for="select-address2">Quận/Huyện</label>
                                <select class="form-control select-address2" name="address2"
                                        id='select-address2'></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Căn cước công dân</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="file" name="identity[]" id="identity"
                                       class="form-control-file"
                                       oninput="identity1.src=window.URL.createObjectURL(this.files[0])">
                                <img id="identity1"
                                     style="max-width: 300px; max-height:200px;"/>
                            </div>
                            <div class="col-6">
                                <input type="file" name="identity[]"
                                       class="form-control-file"
                                       oninput="identity2.src=window.URL.createObjectURL(this.files[0])">
                                <img id="identity2"
                                     style="max-width: 300px; max-height:200px;"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Bằng lái xe</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="file" name="license_car[]" id="identity"
                                       class="form-control-file"
                                       oninput="license_car1.src=window.URL.createObjectURL(this.files[0])">
                                <img id="license_car1"
                                     style="max-width: 300px; max-height:200px;"/>
                            </div>
                            <div class="col-6">
                                <input type="file" name="license_car[]"
                                       class="form-control-file"
                                       oninput="license_car2.src=window.URL.createObjectURL(this.files[0])">
                                <img id="license_car2"
                                     style="max-width: 300px; max-height:200px;"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-success">Tạo hóa
                            đơn
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        function carShow(carId) {
            $.ajax({
                url: '{{ route('api.cars.show') }}/' + carId,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    $.each(response.data, function (index, each) {
                        let image_url = "{{asset('storage/')}}" + '/' + each.image;
                        let li, image;
                        li = "<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "' class='active'></li>";
                        image = "<div class='carousel-item active'>" +
                            "<img class='d-block img-fluid' src='" + image_url + "'>";
                        $('.carousel-indicators').append(li);
                        $('.carousel-inner').append(image);
                        if (each.files.length !== 0) {
                            $.each(each.files, function (index, each) {
                                index += 1;
                                let image_url = "{{asset('storage/')}}" + '/' + each.link;
                                li = "<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "'></li>";
                                image = "<div class='carousel-item'>" +
                                    "<img class='d-block img-fluid' src='" + image_url + "'>";
                                $('.carousel-indicators').append(li);
                                $('.carousel-inner').append(image);
                            })
                        } else {
                            notifyInfo('Xe này chưa có ảnh chi tiết');
                        }
                    })
                }
            });
        }

        function loadNames() {
            $("#select-name").select2();
            let name = '<option selected value="All">Tất cả</option>';
            let selected = '';
            @foreach($names as $name)
                @if($name === $search['filter']['name'])
                selected = 'selected';
            @else
                selected = '';
            @endif
                name += "<option " + selected + `>{{$name}}</option>`;
            @endforeach
            $("#select-name").append(name);
        }

        function filter() {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        }

        $(document).ready(async function () {
            loadNames();
            filter();
            $(document).on('click', '#pagination > li > a', function (event) {
                event.preventDefault();
                let page = $(this).text();
                let urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', page);
                window.location.search = urlParams;
            });

        });
    </script>
@endpush
