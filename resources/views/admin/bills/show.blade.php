@extends('layout_backend.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('bills.show') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="mt-0">KHÁCH THUÊ</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <label>Họ và tên</label>
                        </div>
                        <div class="col-9">
                            <span id="user-info"></span>
                        </div>
                        <div class="col-3">
                            <label for="">SĐT</label>
                        </div>
                        <div class="col-9">
                            <a id="user-phone"></a>
                        </div>
                        <div class="col-3">
                            <label for="">Email</label>
                        </div>
                        <div class="col-9">
                            <a id="user-email"></a>
                        </div>
                        <div class="col-md-12">
                            <div class="d-lg-flex justify-content-center">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h5>Căn cước công dân</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="" id="indentity-front" class="img-fluid p-2"
                                             style="max-width: 250px;" alt="Mặt trước">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="" id="indentity-back" class="img-fluid p-2 ml-2"
                                             style="max-width: 250px;" alt="Mặt sau">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-lg-flex justify-content-center">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h5>Giấy phép lái xe</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="" id="license-car-front" class="img-fluid p-2"
                                             style="max-width: 250px;" alt="Mặt trước">
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="" id="license-car-back" class="img-fluid ml-2 p-2"
                                             style="max-width: 250px;" alt="Mặt sau">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="mt-0">HÓA ĐƠN
                        <div id="bill-status" class="badge "></div>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="form-filter">
                        <div class="form-group row">
                            <label for="select-status" class="col-5 col-form-label">Trạng thái</label>
                            <div class="col-7">
                                <select class="form-control select-filter" name="status" id='select-status'>
                                    @foreach($status as $key => $value)
                                        <option value="{{$key}}">
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$billId}}">
                    </form>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="mt-0">XE THUÊ</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-8">
                            <h3 class="mt-0" id="car-name"></h3>
                            <h5 id="address"></h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Chỗ ngồi</h5>
                                    <p id="slot"></p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Truyền động</h5>
                                    <p id="transmission"></p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Nhiên liệu</h5>
                                    <p id="fuel"></p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Mức tiêu hoa</h5>
                                    <p id="fuel_comsumpiton"></p>
                                </div>
                            </div>
                            <h5>Mô tả:</h5>
                            <p class="text-muted mb-2" id="car-description">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
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
                    //crawlUser
                    $("#user-info").html(user.name + ' - ' + user.gender);
                    $("#user-phone").html(user.phone).attr("href", "tel:" + user.phone);
                    $("#user-email").html(user.email).attr("href", "mailto:" + user.email);
                    $.each(user.files, function (index, each) {
                        let storage = `{{asset('storage')}}/`;
                        if (each.type === {{\App\Enums\FileTypeEnum::IDENTITY_FRONT}}) {
                            $("#indentity-front").attr("src", storage + each.link);
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::IDENTITY_BACK}}) {
                            $("#indentity-back").attr("src", storage + each.link);
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::LICENSE_CAR_FRONT}}) {
                            $("#license-car-front").attr("src", storage + each.link);
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::LICENSE_CAR_BACK}}) {
                            $("#license-car-back").attr("src", storage + each.link);
                        }
                    });
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
                    @foreach($status as $key=> $value)
                    if ({{$key}} === bill.status) {
                        $("#select-status option[value=" + `{{$key}}` + "]").attr('selected', 'selected');
                    }
                    @endforeach
                }
            });
        }

        function carShow(car) {
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

        $(document).ready(async function () {
            crawlBillsShow();
            filter();
            @if (session('bills_success_message'))
            notifySuccess(`{{ session('bills_success_message') }}`);
            @endif
            @if (session('bills_error_message'))
            notifySuccess(`{{ session('bills_error_message') }}`);
            @endif
        });
    </script>
@endpush
