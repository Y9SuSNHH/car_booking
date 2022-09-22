@extends('layout_backend.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('car') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-12">
                            <form class="form-row" id="form-filter">
                                <div class="form-group col-md-3">
                                    <label for="select-name">Tên xe</label>
                                    <select class="form-control select-filter" name="name" id='select-name'>
                                    </select>
                                </div>
                                @if ($isFind !== 0)
                                    <div class="form-group col-md-3">
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
                                    <div class="form-group col-lg-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <i class="mdi mdi-circle text-success"></i> Sẵn sàng
                                            </div>
                                            <div class="col-6">
                                                <i class="mdi mdi-circle text-warning"></i> Bảo dưỡng
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <input type="text" hidden name="city" value="{{$search['find']['city']}}">
                                <input type="text" hidden name="date_start"
                                       value="{{$search['find']['date_start']}}">
                                <input type="text" hidden name="date_end"
                                       value="{{$search['find']['date_start']}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="header-title">
                    <div class="form-group col-md-2">
                        <a href="{{ route("$role.$table.create") }}" class="btn btn-success">Thêm xe</a>
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
                                    @if ($isFind === 0)
                                        <th scope="col">Tạo hóa đơn</th>
                                    @elseif($isFind === 3)
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Xử lý</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $each)
                                    <tr>
                                        <td>{{$each->id}}</td>
                                        <td>
                                            <img src="{{asset("storage").'/'. $each->image}}"
                                                 class="img-fluid img-thumbnail p-1">
                                        </td>
                                        <td>
                                            {{$each->name}}
                                            <br>
                                            {{$each->district}} - {{$each->city}}
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
                                            <span class="badge badge-success">{{$each->price_1_day/1000}} K</span>
                                            <br>
                                            <span
                                                class="badge badge-secondary">{{$each->price_insure}}đ - {{$each->price_service}}đ</span>
                                            <br>
                                            <span
                                                class="badge badge-info">{{date("d-m-Y", strtotime($each->created_at))}}</span>
                                        </td>
                                        @if ($isFind === 0)
                                            <td>
                                                <button type="button" data-toggle="modal" class="btn btn-outline-info"
                                                        data-target="#modal-form-create-bill"
                                                        onclick="modalBillCreate('{{$each->id}}')">
                                                    <i class="uil-money-bill"></i>
                                                </button>
                                            </td>
                                        @elseif($isFind === 3)
                                            <td>
                                                @if ($each->status === 0)
                                                    <i class="mdi mdi-circle text-success"></i>
                                                @else
                                                    <i class="mdi mdi-circle text-warning"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route("$role.$table.edit",$each->id)}}" class='action-icon'><i
                                                        class='mdi mdi-pencil'></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <ul class="pagination pagination-rounded mb-0">
                        {{$data->appends(request()->query())->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-form-create-bill" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-width" role="document">
            <div class="modal-content bg-transparent">
                <div class="modal-body">
                    <form action="" id="form-bills-create">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="modal-title">
                                            Nhập thông tin khách hàng
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="div-error-update" class="alert alert-danger d-none">
                                            <ul id="error-update">
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="name">Họ và tên</label>
                                                <input type="text" class="form-control"
                                                       id="name" name="name">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="number" id="phone" name="phone" class="form-control">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Giới tinh</label>
                                                <div class="mt-2">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input class="custom-control-input" type="radio" name="gender"
                                                               id="genderMale" value="1" checked>
                                                        <label class="custom-control-label"
                                                               for="genderMale">Nam</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input class="custom-control-input" type="radio" name="gender"
                                                               id="genderFemale" value="0">
                                                        <label class="custom-control-label"
                                                               for="genderFemale">Nữ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Căn cước công dân</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <h6>Mặt trước</h6>
                                                <input type="file" name="files[IDENTITY_FRONT]" id="identity"
                                                       class="form-control-file"
                                                       oninput="identity1.src=window.URL.createObjectURL(this.files[0])">
                                                <img id="identity1"
                                                     style="max-width: 300px; max-height:200px;"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <h6>Mặt sau</h6>
                                                <input type="file" name="files[IDENTITY_BACK]" class="form-control-file"
                                                       oninput="identity2.src=window.URL.createObjectURL(this.files[0])">
                                                <img id="identity2"
                                                     style="max-width: 300px; max-height:200px;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Bằng lái xe</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <h6>Mặt trước</h6>
                                                <input type="file" name="files[LICENSE_CAR_FRONT]" id="identity"
                                                       class="form-control-file"
                                                       oninput="license_car1.src=window.URL.createObjectURL(this.files[0])">
                                                <img id="license_car1"
                                                     style="max-width: 300px; max-height:200px;"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <h6>Mặt sau</h6>
                                                <input type="file" name="files[LICENSE_CAR_BACK]"
                                                       class="form-control-file"
                                                       oninput="license_car2.src=window.URL.createObjectURL(this.files[0])">
                                                <img id="license_car2"
                                                     style="max-width: 300px; max-height:200px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="modal-title">Chi phí hóa đơn</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <h6>Đơn giá thuê</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="float-right">
                                                    <span id="price_1_day"></span> /ngày
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <h6>Phí dịch vụ</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="float-right">
                                                    <span id="price_service"></span> /ngày
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <h6>Phí bảo hiểm</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="float-right">
                                                    <span id="price_insure"></span> /ngày
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <h6>Tổng phí thuê xe</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="float-right">
                                                    <span id="price"></span>  x <span id="total-date"></span> ngày
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <h6>Tổng tiền</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="float-right">
                                                    <span id="total-price"></span> đ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Tạo hóa
                                                đơn
                                            </button>
                                        </div>
                                    </div>
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
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
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

        function changeDateType(date) {
            let new_date = date.split('-');
            let day = new_date[0];
            let month = new_date[1];
            let year = new_date[2];
            return month + "/" + day + "/" + year;
        }

        function getDateDiff() {
            let date_start = changeDateType(`{{$search['find']['date_start']}}`);
            let date_end = changeDateType(`{{$search['find']['date_end']}}`);

            date_start = new Date(date_start);
            date_end = new Date(date_end);
            let date_diff = new Date(date_end - date_start);
            return date_diff / 1000 / 60 / 60 / 24;
        }

        function modalBillCreate(carId) {
            let route = '{{route("api.bills.store")}}/' + carId;
            $('#form-bills-create').prop('action', route);
            $('#form-bills-create').prop('method', 'POST');
            crawlInfoBill(carId);
        }

        function crawlPrice(price) {
            return price.toLocaleString('vi');
        }

        function crawlInfoBill(carId) {
            $.ajax({
                url: '{{ route("api.$table.show") }}/' + carId,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    $.each(response.data, function (index, each) {
                        $("#price_1_day").html(crawlPrice(each.price_1_day));
                        $("#price_insure").html(crawlPrice(each.price_insure));
                        $("#price_service").html(crawlPrice(each.price_service));
                        let price = each.price_1_day + each.price_insure + each.price_service;
                        $("#price").html(crawlPrice(price));
                        $("#total-date").html(getDateDiff());
                        let total_price = getDateDiff() * price;
                        $("#total-price").html(crawlPrice(total_price));
                    })
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
            $("#error-update").html(string);
            $("#div-error-update").removeClass("d-none").show();
        }

        function submitFormBillStore() {
            const obj = $("#form-bills-create");
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
                    let route = '{{route('admin.bills.show')}}/' + response.data;
                    window.location.assign(route);
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
            loadNames();
            filter();
            @if (session('cars_success_message'))
            notifySuccess(`{{ session('cars_success_message') }}`);
            @endif

            $("#form-bills-create").validate({
                submitHandler: function () {
                    submitFormBillStore()
                }
            });

        });
    </script>
@endpush
