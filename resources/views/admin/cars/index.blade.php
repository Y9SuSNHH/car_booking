@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-8">
                            <form class="form-horizontal form-inline" id="form-filter">
                                <div class="form-group col-md-3">
                                    <label for="select-car-name">Tên xe</label>
                                    <select class="form-control" name="select-car-name" id="select-car-name">
                                        <option selected value="All">Tất cả</option>
                                        {{--                                        @foreach($names as $name)--}}
                                        {{--                                            <option--}}
                                        {{--                                                @if($name === $selectedName) selected @endif--}}
                                        {{--                                            >--}}
                                        {{--                                                {{ $name }}--}}
                                        {{--                                            </option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-4">
                            <nav class="float-right">
                                <ul class="pagination pagination-rounded mb-0" id="pagination">
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
                    <div class="tab-content">
                        <table id="table-data" class="table table-striped table-centered mb-0" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Biển số</th>
                                <th>Thông tin xe</th>
                                <th>Loại xe</th>
                                <th>Nhiên liệu</th>
                                <th>
                                    Giá thuê 1 ngày
                                    <br>
                                    Phí bảo hiểm - dịch vụ
                                    <br>
                                    Ngày thêm
                                </th>
                                <th>Trạng thái</th>
                                <th>Xử lý</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="modal fade" id="popup-images" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Toàn bộ ảnh xe</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                               role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Sau</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators"
                                               role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Trước</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="form-create-bill" class="modal fade bd-example-modal-lg"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
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

        function crawlData() {
            $.ajax({
                url: '{{route('api.cars')}}',
                dataType: 'json',
                data: {page: {{ request()->get('page') ?? 1 }}},
                success: function (response) {
                    response.data.data.forEach(function (each) {
                        let image_url = "{{asset('storage/')}}" + '/' + each.image;
                        let image = "<button type='button' id='btn-popup-images-" + each.id + "' data-toggle='modal' data-target='#popup-images' class='btn btn-link btn-rounded'>"
                            + "<img src='" + image_url
                            + "' class='img-fluid img-thumbnail p-1'"
                            + "style='max-width: 300px; max-height:200px;'> </button>";
                        let address = "- " + each.address + "<br>- " + each.address2;
                        let info = "- " + each.name + "<br>" + address;
                        let transmission = each.transmission ? "<span class='badge badge-primary'>Số tự động</span>" : "<span class='badge badge-info'>Số sàn</span>";
                        let type = each.type + "<br>" +
                            "<span class='badge badge-warning'>" + each.slot + " chỗ</span>"
                            + "<br>" + transmission;
                        let fuel = each.fuel ? "<span class='badge badge-success'>Xăng</span>" : "<span class='badge badge-secondary'>Dầu</span>" + "<br>" + each.fuel_comsumpiton + " L/km";
                        let price = each.price_1_day + "đ<br>" + each.price_insure + 'đ - ' + each.price_service
                            + "đ<br>" + convertDateToDateTime(each.created_at);
                        let status_ready = "<button type='button' id='btn-form-create-bill-" + each.id + "' data-toggle='modal' data-target='#form-create-bill' class='btn btn-outline-info'><i class='uil-money-bill'></i></button>";
                        let status_maintenance = "<span class='badge badge-warning-lighten'>" + each.status_name + "</span>";
                        let status = each.status ? status_maintenance : status_ready;
                        let route_car_edit = '{{route("admin.cars.edit","id")}}';
                        route_car_edit = route_car_edit.replace('id', each.id);
                        let route_car_destroy = '{{route("admin.cars.destroy","id")}}';
                        route_car_destroy = route_car_destroy.replace('id', each.id);
                        {{--let action = "<form action='#'><a href='" + route_car_edit + "' class='action-icon'><i class='mdi mdi-wrench'></i></a></form>" +--}}
                        {{--    "<form action='" + route_car_destroy + "' method='post' class='action-icon'>@csrf @method('DELETE')" +--}}
                        {{--    "<button class='btn btn-link action-icon'><i class='dripicons-trash'></i></button></form>";--}}

                        $('#table-data').append($('<tr>')
                                .append($('<td>').append(each.id))
                                .append($('<td>').append(image))
                                .append($('<td>').append(info))
                                .append($('<td>').append(type))
                                .append($('<td>').append(fuel))
                                .append($('<td>').append(price))
                                .append($('<td>').append(status))
                            // .append($('<td>').append(action))
                        );
                        $(document).on('click', '#btn-form-create-bill-' + each.id, function (event) {
                            let route_bill_store = '{{route('admin.bills.store',"id")}}';
                            route_bill_store = route_bill_store.replace('id', each.id);
                            $("#action-bill-store").attr("action", route_bill_store);
                        });
                        $(document).on('click', '#btn-popup-images-' + each.id, function () {
                            $('.carousel-indicators').empty();
                            $('.carousel-inner').empty();
                            getImage(each.id);
                        });
                    });
                    renderPagination(response.data.pagination);
                },
                error: function () {
                    notifyError();
                }
            })
        }

        function getImage(carId) {
            $.ajax({
                url: '{{ route('api.files.cars.carImage') }}/' + carId,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if (response.data.length !== 0) {
                        $.each(response.data, function (index, each) {
                            let image_url = "{{asset('storage/')}}" + '/' + each.link;
                            let li, image;
                            if (index === 0) {
                                li = "<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "' class='active'></li>";
                                image = "<div class='carousel-item active'>" +
                                    "<img class='d-block img-fluid' src='" + image_url + "'>";
                            } else {
                                li = "<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "'></li>";
                                image = "<div class='carousel-item'>" +
                                    "<img class='d-block img-fluid' src='" + image_url + "'>";
                            }
                            $('.carousel-indicators').append(li);
                            $('.carousel-inner').append(image);
                        })
                    } else {
                        notifyInfo('Xe này chưa có ảnh chi tiết');
                    }
                }
            });
        }

        $(document).ready(async function () {
            crawlData();

            $(document).on('click', '#pagination > li > a', function (event) {
                event.preventDefault();
                let page = $(this).text();
                let urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', page);
                window.location.search = urlParams;
            });

            $("#select-address").select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            $.each(address, function (index, each) {
                $("#select-address").append(`
                <option value='${each.code}' data-path='${each.file_path}'>
                    ${index}
                </option>`);
            })

            $("#select-address").change(function () {
                loadDistrict();
            });
            $("#select-address2").select2();
            await loadDistrict();

            $('#form-create-bill').modal('show');
            // $('#popup-image').modal('show');
        });
    </script>
@endpush
