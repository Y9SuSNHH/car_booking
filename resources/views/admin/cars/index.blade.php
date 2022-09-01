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
                                <ul class="pagination pagination-rounded mb-0">
                                    <nav>
                                        <ul class="pagination" id="pagination">
                                        </ul>
                                    </nav>
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
                                <table id="table-data" class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Biển số</th>
                                        <th scope="col">Thông tin xe</th>
                                        <th scope="col">Loại xe</th>
                                        <th scope="col">Nhiên liệu</th>
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
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-each-car" tabindex="-1" role="dialog"
         aria-labelledby="scrollableModalTitle"
         aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <div class="row">
            <div class="col-lg-8">
                <div class="modal-dialog modal-lg float-right" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div id="carouselExampleIndicators" class="carousel slide"
                                                 data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                </ol>
                                                <div class="carousel-inner" role="listbox">
                                                </div>
                                                <a class="carousel-control-prev"
                                                   href="#carouselExampleIndicators"
                                                   role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Sau</span>
                                                </a>
                                                <a class="carousel-control-next"
                                                   href="#carouselExampleIndicators"
                                                   role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Trước</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="info-car--desc">
                                                <div class="group"><span
                                                        class="lstitle-new">ĐẶC ĐIỂM</span>
                                                    <div class="ctn-desc-new">
                                                        <ul class="features">
                                                            <li><i class="ic ic-chair"></i> Số ghế: 5
                                                            </li>
                                                            <li><i class="ic ic-trans"></i> Truyền động:
                                                                Số tự động
                                                            </li>
                                                            <li><i class="ic ic-diesel"></i> Nhiên liệu:
                                                                Xăng
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="group"><span
                                                        class="lstitle-new">MÔ TẢ</span>
                                                    <div class="ctn-desc-new"><pre>-Xe đẹp được kiểm tra bảo dưỡng định kỳ 5.000km tại hãng KIA nhằm đảm bảo an toàn nhất cho khách hàng ..
-Kia Cerato Fulloption rộng rãi (phân khúcC), sạch sẽ, nội thất  mới, lót sàn 6D, đầy đủ Camera hành trình, Cam lùi, dẫn đường, Sạc điện thoại ko dây...
-Rửa xe sạch sẽ khi giao khách. Rất hân hạnh được phục vụ.</pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="modal-dialog modal-sm float-left">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="rent-box rent-car" id="booking-sidebar">
                                                <div class="price"><h3>739K <span> / ngày</span></h3>
                                                </div>
                                                <div class="line-form has-timer"><label class="label">Ngày
                                                        nhận xe</label>
                                                    <div class="wrap-input has-dropdown date">
                                                        <div
                                                            class="react-bootstrap-daterangepicker-container"
                                                            style="display: inline-block;"><span
                                                                class="value">15/08/2022</span></div>
                                                    </div>
                                                </div>
                                                <div class="line-form has-timer"><label class="label">Ngày
                                                        trả xe</label>
                                                    <div class="wrap-input has-dropdown date">
                                                        <div
                                                            class="react-bootstrap-daterangepicker-container"
                                                            style="display: inline-block;"><span
                                                                class="value">16/08/2022</span></div>
                                                    </div>
                                                </div>
                                                <div class="line-form notice-form note"><p
                                                        class="d-flex-between">Thời gian
                                                        nhận xe <span>06:00-22:00 </span>
                                                    </p>
                                                    <p class="d-flex-between">Thời gian trả xe <span>18:00-21:00</span>
                                                    </p>
                                                </div>
                                                <div class="line-form local"><label>Địa điểm giao nhận
                                                        xe</label>
                                                    <div class="note">
                                                        <p class="pickup">
                                                            <svg class="icsvg" viewBox="0 0 24 24"
                                                                 style="fill: none;">
                                                                <path
                                                                    d="m12 22.5c5.799 0 10.5-4.701 10.5-10.5 0-5.799-4.701-10.5-10.5-10.5-5.799 0-10.5 4.701-10.5 10.5 0 5.799 4.701 10.5 10.5 10.5zm0 1.5c6.6274 0 12-5.3726 12-12 0-6.6274-5.3726-12-12-12-6.6274 0-12 5.3726-12 12 0 6.6274 5.3726 12 12 12z"
                                                                    clip-rule="evenodd" fill="#141414"
                                                                    fill-rule="evenodd"></path>
                                                                <path
                                                                    d="m7.5 10.494c0-2.4778 2.0187-4.4937 4.5-4.4937 2.4813 0 4.5 2.0159 4.5 4.4937 0 1.2789-0.7204 2.918-2.1412 4.8719-1.0399 1.4301-2.0635 2.484-2.1066 2.5281-0.0662 0.068-0.1572 0.1063-0.2522 0.1063s-0.186-0.0383-0.2522-0.1063c-0.0431-0.0442-1.0667-1.098-2.1066-2.5281-1.4208-1.9539-2.1412-3.593-2.1412-4.8719zm4.5095 1.5064c0.9955 0 1.8025-0.8059 1.8025-1.8 0-0.99411-0.807-1.8-1.8025-1.8s-1.8025 0.80589-1.8025 1.8c0 0.9941 0.807 1.8 1.8025 1.8z"
                                                                    clip-rule="evenodd" fill="#141414"
                                                                    fill-rule="evenodd"></path>
                                                            </svg>
                                                            Quận 10, Hồ Chí Minh
                                                        </p>
                                                        <p class="subnote">
                                                            <span> Không hỗ trợ giao nhận xe tận nơi. </span>
                                                            Địa chỉ cụ thể
                                                            sẽ được hiển thị sau khi đặt cọc</p></div>
                                                </div>
                                                <div class="line-form local"><label>Giới hạn số km
                                                        <div class="tooltip"><i
                                                                class="ic ic-question-mark"></i>
                                                            <div class="tooltip-text">Nếu bạn thuê xe
                                                                nhiều hơn 1 ngày: Giới
                                                                hạn số km =
                                                                Giới hạn 1 ngày x Tổng số ngày đi
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <div class="note">
                                                        <div class="note"><p>Tối đa <strong>350</strong>
                                                                km/ngày. Phí
                                                                <strong>5K</strong>/km
                                                                vượt giới hạn.</p></div>
                                                    </div>
                                                </div>
                                                <div class="line-form local">
                                                    <div class="note insurance"><label>Bảo hiểm </label>
                                                        <p><a><i class="ic ic-act-insurance"></i>Chuyến
                                                                đi được bảo hiểm bởi
                                                                MIC<span
                                                                    class="link-trip font-13"> Tìm hiểu thêm</span></a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="car-bill"><h4 class="text-center">Chi tiết
                                                        giá</h4>
                                                    <div class="bill-wrap">
                                                        <div class="group"><p>Đơn giá thuê
                                                            <div class="tooltip"><i
                                                                    class="ic ic-question-mark"></i>
                                                                <div class="tooltip-text">Giá thuê xe
                                                                    không bao gồm tiền
                                                                    xăng. Khi kết thúc
                                                                    chuyến đi, bạn sẽ đổ xăng về lại mức
                                                                    ban đầu như khi
                                                                    nhận xe.
                                                                </div>
                                                            </div>
                                                            </p><span><span>739 000 / ngày</span></span>
                                                        </div>
                                                        <div class="group">
                                                            <div>Phí dịch vụ
                                                                <div class="tooltip"><i
                                                                        class="ic ic-question-mark"></i>
                                                                    <div class="tooltip-text">Phí dịch
                                                                        vụ nhằm hỗ trợ Mioto
                                                                        duy trì nền tảng
                                                                        ứng dụng và các hoạt động chăm
                                                                        sóc khách hàng một
                                                                        cách tốt nhất.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span><span>62 815 / ngày</span></span>
                                                        </div>
                                                        <div class="group">
                                                            <div>Phí bảo hiểm
                                                                <div class="tooltip"><i
                                                                        class="ic ic-question-mark"></i>
                                                                    <div class="tooltip-text">Chuyến đi
                                                                        của bạn được mua gói
                                                                        bảo hiểm vật
                                                                        chất xe ô tô từ nhà bảo hiểm
                                                                        MIC. Trường hơp có sự
                                                                        cố ngoài ý muốn
                                                                        (trong phạm vi bảo hiểm), số
                                                                        tiền bạn thanh toán tối
                                                                        đa là
                                                                        2,000,000VND/vụ.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span><span>62 815 / ngày</span></span>
                                                        </div>
                                                        <div class="group has-line"><p>Tổng phí thuê
                                                                xe</p>
                                                            <span><span>864 630</span> x <strong>1 ngày</strong></span>
                                                        </div>
                                                        <div class="group has-line"><p><strong>Tổng
                                                                    cộng</strong></p>
                                                            <span><strong><span>864 630đ</span></strong></span>
                                                        </div>
                                                    </div>
                                                    <div class="space m"></div>
                                                    <div class="promotion-code d-flex"><a
                                                            class="title-new"><h4
                                                                class="lstitle-new">Mã
                                                                khuyến mãi</h4></a></div>
                                                    <div class="space m"></div>
                                                    <div class="space m"></div>
                                                    <div class="wrap-btn"><a
                                                            class="btn btn-primary btn--m"><i
                                                                class="ic ic-thunderbolt-wh"></i>ĐẶT XE</a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="daterangepicker dropdown-menu ltr show-calendar openscenter">
                                                    <div class="calendar left">
                                                        <div class="daterangepicker_input hidden"><input
                                                                class="input-mini form-control"
                                                                type="text"
                                                                name="daterangepicker_start"
                                                                value=""><i
                                                                class="fa fa-calendar glyphicon glyphicon-calendar"></i>
                                                            <div class="calendar-time">
                                                                <div></div>
                                                                <i class="fa fa-clock-o glyphicon glyphicon-time"></i>
                                                            </div>
                                                        </div>
                                                        <div class="calendar-table"></div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="daterangepicker dropdown-menu ltr show-calendar openscenter">
                                                    <div class="calendar left">
                                                        <div class="daterangepicker_input hidden"><input
                                                                class="input-mini form-control"
                                                                type="text"
                                                                name="daterangepicker_start"
                                                                value=""><i
                                                                class="fa fa-calendar glyphicon glyphicon-calendar"></i>
                                                            <div class="calendar-time">
                                                                <div></div>
                                                                <i class="fa fa-clock-o glyphicon glyphicon-time"></i>
                                                            </div>
                                                        </div>
                                                        <div class="calendar-table"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
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
        function crawlData() {
            $.ajax({
                url: '{{route('api.cars',$search)}}',
                dataType: 'json',
                data: {page: {{ request()->get('page') ?? 1 }}},
                success: function (response) {
                    response.data.data.forEach(function (each) {
                        let image_url = "{{asset('storage/')}}" + '/' + each.image;
                        let image = "<button type='button' id='btn-modal-each-car-" + each.id + "' data-toggle='modal' data-target='#modal-each-car' class='btn btn-link btn-rounded'>"
                            + "<img src='" + image_url
                            + "' class='img-fluid img-thumbnail p-1'"
                            + "style='max-width: 300px; max-height:200px;'> </button>";
                        let address = "- " + each.address + "<br>- " + each.address2;
                        let info = "- " + each.name + "<br>" + address;
                        let transmission = each.transmission ? "<span class='badge badge-primary'>Số tự động</span>" : "<span class='badge badge-info'>Số sàn</span>";
                        let type = each.type + "<br>" +
                            "<span class='badge badge-warning'>" + each.slot + " chỗ</span>"
                            + "<br>" + transmission;
                        let fuel = each.fuel ? "<span class='badge badge-secondary'>Dầu</span>" : "<span class='badge badge-success'>Xăng</span>" + "<br>" + each.fuel_comsumpiton + " L/km";
                        let price = each.price_1_day + "đ<br>" + each.price_insure + 'đ - ' + each.price_service
                            + "đ<br>" + convertDateToDateTime(each.created_at);
                        let status_ready;
                        @if (isset($search['address']) && isset($search['date_start']) && isset($search['date_end']))
                            status_ready = "<button type='button' id='btn-modal-form-create-bill-" + each.id + "' data-toggle='modal' data-target='#modal-form-create-bill' class='btn btn-outline-info'><i class='uil-money-bill'></i></button>";
                        @else
                            status_ready = "<span class='badge badge-success-lighten'>" + each.status_name + "</span>";
                        @endif
                        let status_maintenance = "<span class='badge badge-warning-lighten'>" + each.status_name + "</span>";
                        let status = each.status ? status_maintenance : status_ready;
                        let route_car_edit = '{{route("admin.cars.edit","id")}}';
                        route_car_edit = route_car_edit.replace('id', each.id);
                        let route_car_destroy = '{{route("admin.cars.destroy","id")}}';
                        route_car_destroy = route_car_destroy.replace('id', each.id);
                        let action = "<a href='" + route_car_edit + "' class='action-icon'><i class='mdi mdi-pencil'></i></a>";
                        action += "<form action='" + route_car_destroy + "' method='post' class='action-icon' id='form-car-delete' style='margin: 0px;padding: 0px;''>";
                        action += `@csrf @method('DELETE')`;
                        action += "<button class='btn btn-link action-icon''><i class='mdi mdi-delete'></i></button>";
                        action += "</form>";
                        $('#table-data').append($('<tr>')
                            .append($('<th scope="row">').append(each.id))
                            .append($('<td>').append(image))
                            .append($('<td>').append(info))
                            .append($('<td>').append(type))
                            .append($('<td>').append(fuel))
                            .append($('<td>').append(price))
                            .append($('<td>').append(status))
                            .append($('<td class="table-action">').append(action))
                        );
                        $(document).on('click', '#btn-modal-form-create-bill-' + each.id, function (event) {
                            let route_bill_store = '{{route('admin.bills.store',"id")}}';
                            route_bill_store = route_bill_store.replace('id', each.id);
                            $("#action-bill-store").attr("action", route_bill_store);
                        });
                        $(document).on('click', '#btn-modal-each-car-' + each.id, function () {
                            $('.carousel-indicators').empty();
                            $('.carousel-inner').empty();
                            carShow(each.id);
                        });
                    });
                    renderPagination(response.data.pagination);
                },
                error: function () {
                    notifyError();
                }
            })
        }

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

        $(document).ready(async function () {
            crawlData();

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
