@extends('layout_frontend.master')
@section('content')
    <div class="section section-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-contact no-transition">
                        <div class="card-header text-center">
                            <h4 class="mt-0 font-weight-bold">XE THUÊ</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="carouselExampleIndicators" class="carousel slide"
                                         data-ride="carousel">
                                        <ol class="carousel-indicators"></ol>
                                        <div class="carousel-inner" role="listbox"></div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Sau</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Trước</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="mt-0 font-weight-bold" id="car-name"></h3>
                                    <h5 id="address"></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Chỗ ngồi</h6>
                                            <p id="slot"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Truyền động</h6>
                                            <p id="transmission"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Nhiên liệu</h6>
                                            <p id="fuel"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Mức tiêu hoa</h6>
                                            <p id="fuel_comsumpiton"></p>
                                        </div>
                                    </div>
                                    <h6>Mô tả:</h6>
                                    <p class="text-muted mb-2" id="car-description">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-contact no-transition">
                        <div class="card-header text-center">
                            <h4 class="mt-0 font-weight-bold">HÓA ĐƠN
                                <div id="bill-status" class="badge "></div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Mô tả</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Ngày bắt đầu :</td>
                                        <td><span id="date_start"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Ngày kết thúc :</td>
                                        <td><span id="date_end"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Giá 1 ngày :</td>
                                        <td><span id="price_1_day"></span> / ngày</td>
                                    </tr>
                                    <tr>
                                        <td>Phí bảo hiểm :</td>
                                        <td><span id="price_insure"></span> / ngày</td>
                                    </tr>
                                    <tr>
                                        <td>Phí dịch vụ :</td>
                                        <td><span id="price_service"></span> / ngày</td>
                                    </tr>
                                    <tr>
                                        <td>Tổng phí thuê xe :</td>
                                        <td><span id="price"></span> x <span id="total-date"></span> ngày</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền :</th>
                                        <th><span id="total_price"></span> đ</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row buttons-row">--}}
{{--                <div class="col-md-4 ml-auto mr-auto">--}}
{{--                    <form id="form-bills-store">--}}
{{--                        @csrf--}}
{{--                        <button class="btn btn-outline-primary btn-block btn-round">--}}
{{--                            <i class="nc-icon nc-cart-simple"></i> Thanh toán--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        function changeDateType(date) {
            let new_date = date.split('-');
            let day = new_date[0];
            let month = new_date[1];
            let year = new_date[2];
            return month + "/" + day + "/" + year;
        }

        function crawlPrice(price) {
            return price.toLocaleString('vi');
        }

        function filter() {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        }

        function crawlBillsShow() {
            $.ajax({
                url: '{{ route("api.$table.show",$billId) }}',
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    const bill = response.data;
                    const user = response.data.user;
                    const files = response.data.files;
                    const car = response.data.car;
                    //crawlCar
                    carShow(car);
                    //crawlBill
                    $("#date_start").html(bill.date_start);
                    $("#date_end").html(bill.date_end);
                    $("#price_1_day").html(crawlPrice(car.price_1_day));
                    $("#price_insure").html(crawlPrice(car.price_insure));
                    $("#price_service").html(crawlPrice(car.price_service));
                    let price = car.price_1_day + car.price_insure + car.price_service;
                    $("#price").html(crawlPrice(price));
                    $("#total-date").html(bill.date_diff);
                    $("#total_price").html(crawlPrice(bill.total_price));
                    $("#bill-status").html(bill.status_name).addClass('badge-outline-' + bill.generate_status);
                }
            });
        }

        function carShow(car) {
            let route = `{{route("api.$table.store")}}/`+car.id;
            $('#form-bills-store').prop('action', route);
            $('#form-bills-store').prop('method', 'POST');

            let image_url = "{{asset('storage/')}}" + '/' + car.image;
            let li, image;
            li = "<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
            image = "<div class='carousel-item active'>" +
                "<img class='d-block img-fluid' src='" + image_url + "'>";
            $('.carousel-indicators').append(li);
            $('.carousel-inner').append(image);
            $("#car-name").html(car.name);
            $("#address").html(car.district + ' - ' + car.city);
            $("#slot").html(car.slot + ' chỗ');
            $("#fuel").html(car.fuel ? '<span class="badge badge-dark-lighten">Dầu</span>' : '<span class="badge badge-success-lighten">Xăng</span>');
            $("#transmission").html(car.transmission ? '<span class="badge badge-primary">Số tự động</span>' : '<span class="badge badge-info">Số sàn</span>');
            $("#fuel_comsumpiton").html(car.fuel_comsumpiton + ' L/km');
            $("#car-description").html(car.description);

            if (car.files.length !== 0) {
                $.each(car.files, function (index, each) {
                    index += 1;
                    let image_url = "{{asset('storage/')}}" + '/' + each.link;
                    li = "<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "'></li>";
                    image = "<div class='carousel-item'>" +
                        "<img class='d-block img-fluid' src='" + image_url + "'>";
                    $('.carousel-indicators').append(li);
                    $('.carousel-inner').append(image);
                })
            }
        }

        function submitFormBillStore() {
            $("#form-bills-store").validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(form).serialize(),
                        success: function (response) {
                            let route = '{{route('user.bills.show')}}/' + response.data;
                            window.location.assign(route);
                        },
                        error: function (response) {
                            $('#modal-each-car').modal('hide');
                            $("#error-bills-store").html(response.responseJSON.message);
                            $('#alert-user-index').modal('show');
                        },
                    });
                }
            });
        }

        $(document).ready(async function () {
            crawlBillsShow();
            filter();
            submitFormBillStore();
            @if (session('bills_success_message'))
            notifySuccess(`{{ session('bills_success_message') }}`);
            @endif
            @if (session('bills_error_message'))
            notifySuccess(`{{ session('bills_error_message') }}`);
            @endif
        });
    </script>
@endpush
