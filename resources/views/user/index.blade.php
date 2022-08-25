@extends('layout_frontend.master')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="collapse-panel">
                <div class="card-header">
                    <form action="{{route('api.cars.list')}}" class="form-group"
                          id="form-list-car">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="address">Tỉnh/TP</label>
                                <select class="form-control" name="address"
                                        id="address">
                                    @foreach($addressCars as $addressCar)
                                        <option value="{{$addressCar}}" class="text-black"
                                                @if ($addressCar === session()->get('address'))
                                                    selected
                                                @endif
                                                @if ($loop->first)
                                                    selected
                                            @endif>
                                            {{ $addressCar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_start">Ngày bắt đầu</label>
                                <input type="date" name="date_start" id="date_start"
                                       min="{{now()->addDays()->toDateString()}}"
                                       class="form-control" value="{{session()->get('date_start')}}">
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_end">Ngày kết thúc</label>
                                <input type="date" name="date_end" id="date_end"
                                       min="{{now()->addDays(2)->toDateString()}}"
                                       class="form-control" value="{{session()->get('date_end')}}">
                            </div>
                            <br>
                            <div class="col-md-8 ml-auto mr-auto">
                                <button class="btn btn-success btn-round btn-block">
                                    Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="card card-refine card-plain">
                        <h4 class="card-title">
                            Refine
                            <button class="btn btn-default btn-icon btn-neutral pull-right" rel="tooltip"
                                    title="" data-original-title="Reset Filter">
                                <i class="arrows-1_refresh-69 now-ui-icons"></i>
                            </button>
                        </h4>
                        <div class="card-header" role="tab" id="headingOne">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    Price Range
                                    <i class="now-ui-icons arrows-1_minimal-down"></i>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="card-body">
                                            <span id="price-left" class="price-left pull-left"
                                                  data-currency="€">€42</span>
                                <span id="price-right" class="price-right pull-right"
                                      data-currency="€">€880</span>
                                <div class="clearfix"></div>
                                <div id="sliderRefine"
                                     class="slider slider-refine noUi-target noUi-ltr noUi-horizontal">
                                    <div class="noUi-base">
                                        <div class="noUi-origin" style="left: 1.37931%;">
                                            <div class="noUi-handle noUi-handle-lower" data-handle="0"
                                                 style="z-index: 5;"></div>
                                        </div>
                                        <div class="noUi-connect"
                                             style="left: 1.37931%; right: 2.29885%;"></div>
                                        <div class="noUi-origin" style="left: 97.7011%;">
                                            <div class="noUi-handle noUi-handle-upper" data-handle="1"
                                                 style="z-index: 4;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                    <div class="row">
                        @foreach($cars as $car)
                            <x-car.list :car="$car"></x-car.list>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 ml-auto mr-auto">
                    <ul class="pagination">
                        {{$cars->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-each-car" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">X</button>
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content bg-transparent text-dark shadow-none">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 ml-auto">
                                <div class="row">
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
                                    </div>
                                </div>
                                <div class="row" style="color: black !important">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong class="category">ĐẶC ĐIỂM</strong>
                                                </div>
                                                <div class="col-3 p-0">
                                                    <div class="feed-line">
                                                        <i class="mdi mdi-seatbelt"></i>
                                                        <span>Số ghế: </span>
                                                        <span id="slot"></span>
                                                    </div>
                                                    <br>
                                                    <div class="feed-line">
                                                        <i class="mdi mdi-engine"></i>
                                                        <span>Nhiên liệu: </span>
                                                        <span id="fuel"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="feed-line">
                                                        <i class="mdi mdi-car-shift-pattern"></i>
                                                        <span>Truyền động: </span>
                                                        <span id="transmission"></span>
                                                    </div>
                                                    <br>
                                                    <div class="feed-line">
                                                        <i class="mdi mdi-fuel"></i>
                                                        <span>Mức tiêu thụ nhiên liệu: </span>
                                                        <span id="fuel_comsumpiton"></span>
                                                        <span>L/Km</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong class="category">MÔ TẢ</strong>
                                                </div>
                                                <div class="col-9">
                                                    <span id="description"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="color: black !important">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong class="category">ĐIỀU KHOẢN</strong>
                                                </div>
                                                <div class="col-9">
                                                <span>
                                                    1. Giấy tờ thuê xe (bản gốc)
                                                        <br>
                                                        ◦ Chấp nhận Passport/Hộ khẩu Thành phố/KT3 Thành phố/Hộ khẩu tỉnh (giữ lại khi nhận xe).
                                                        <br>
                                                        ◦ CMND và GPLX (đối chiếu và trả lại cho khách).
                                                        <br>
                                                        <br>
                                                    2. Tài sản đặt cọc (1 trong 2 hình thức)
                                                        <br>
                                                        ◦ Xe máy (giá trị &gt;15tr) &amp; cà vẹt (bản gốc); hoặc Cọc tiền mặt/chuyển khoản 15tr .
                                                        <br>
                                                        <br>
                                                    3. Phụ thu
                                                        <br>
                                                        ◦ Quá giờ:
                                                        <br>
                                                            - 70,000đ/h. Quá 5h tính bằng giá thuê 1 ngày.
                                                        <br>
                                                        ◦ Vệ sinh, khử mùi xe (nếu có):
                                                        <br>
                                                            - 80,000đ (nếu xe trả nhiều vết bẩn, bùn cát, sình lầy… cần phải vệ sinh lại trước khi giao cho khách sau).
                                                        <br>
                                                            - 400,000đ (nếu hút thuốc lá trong xe, chở sầu riêng, hải sản nặng mùi, mùi hôi khác…. cần phải đi khử mùi trước khi giao cho khách sau).
                                                        <br>
                                                        <br>
                                                    4. Quy định khác:
                                                        <br>
                                                        ◦ Sử dụng xe đúng mục đích.
                                                        <br>
                                                        ◦ Không sử dụng xe thuê vào mục đích phi pháp, trái pháp luật.
                                                        <br>
                                                        ◦ Không sửa dụng xe thuê để cầm cố, thế chấp.
                                                        <br>
                                                        ◦ Không hút thuốc, nhả kẹo cao su, xả rác trong xe.
                                                        <br>
                                                        ◦ Không chở hàng quốc cấm dễ cháy nổ.
                                                        <br>
                                                        ◦ Không chở hoa quả, thực phẩm nặng mùi trong xe.
                                                        <br>
                                                        ◦ Khi trả xe, nếu xe bẩn hoặc có mùi trong xe, khách hàng vui lòng vệ sinh xe sạch sẽ hoặc gửi phụ thu phí vệ sinh xe.
                                                        <br>
                                                        Trân trọng cảm ơn, chúc quý khách hàng có những chuyến đi tuyệt vời !
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mr-auto pl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="form-each-car">
                                            <div class="row">
                                                <div class="col-8 ml-auto mr-auto">
                                                    <h3 class="text-center">
                                                    <span class="text-success font-weight-bold"><span
                                                            class="price_1_day"></span>K</span>
                                                        <small class="text-muted">/ngày</small>
                                                    </h3>
                                                </div>
                                                <div class="col-6 ml-auto mr-auto">
                                                    <label for="date_start" class="font-weight-bold">Ngày bắt
                                                        đầu</label>
                                                    <input type="date" class="form-control"
                                                           min="{{now()->addDays()->toDateString()}}"
                                                           value="{{session()->get('date_start')}}" disabled>
                                                </div>
                                                <div class="col-6 ml-auto mr-auto">
                                                    <label for="date_end" class="font-weight-bold">Ngày kết thúc</label>
                                                    <input type="date" class="form-control"
                                                           min="{{now()->addDays(2)->toDateString()}}"
                                                           value="{{session()->get('date_end')}}" disabled>
                                                </div>
                                                <br>
                                                <div class="col-12 ml-auto mr-auto mt-2 ">
                                                    <div class="alert alert-warning show mb-0 p-0">
                                                        <p class="mb-0">
                                                            <small> Thời gian nhận xe
                                                                <span class="float-right">05:00-22:00</span>
                                                            </small>
                                                        </p>
                                                        <p class="mb-0">
                                                            <small> Thời gian trả xe
                                                                <span class="float-right">17:00-21:00 </span>
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-12 ml-auto mr-auto">
                                                    <strong>Địa điểm nhận xe</strong>
                                                    <h6>
                                                        <i class="now-ui-icons location_compass-05"> <span
                                                                id="address2"></span></i>
                                                    </h6>
                                                    <small class="text-muted">Không hỗ trợ giao nhận xe tận nơi. Địa chỉ
                                                        cụ
                                                        thể sẽ được hiển thị sau khi đặt cọc</small>
                                                </div>
                                                <div class="col-12 ml-auto mr-auto">
                                                    <strong>Giới hạn số km</strong><br>
                                                    <span>
                                                    <small>
                                                        Tối đa
                                                    <strong>300</strong>
                                                    km/ngày. Phí
                                                    <strong>2K</strong>
                                                    /km vượt giới hạn.
                                                    </small>
                                                </span>
                                                </div>
                                                <div class="col-12 ml-auto mr-auto">
                                                    <strong>Bảo hiểm</strong><br>
                                                    <span>
                                                    <small>Chuyến đi được bảo hiểm bởi MIC Tìm hiểu thêm</small>
                                                </span>
                                                </div>
                                                <div class="col-12 ml-auto mr-auto">
                                                    <strong>Chi tiết giá</strong><br>
                                                    <span>
                                                    Đơn giá thuê<i class="mdi mdi-information-outline"
                                                                   data-toggle="tooltip" data-placement="top" title=""
                                                                   data-container="body" data-animation="true"
                                                                   data-html="true"
                                                                   data-original-title="<small>Giá thuê xe không bao gồm tiền xăng. Khi kết thúc chuyến đi, bạn sẽ đổ xăng về lại mức ban đầu như khi nhận xe.</small>"></i>
                                                    <span class="float-right"><span
                                                            class="font-weight-bold"><span class="price_1_day"></span> </span> / ngày</span>
                                                </span>
                                                    <br>
                                                    <span>
                                                    Phí dịch vụ<i class="mdi mdi-information-outline"
                                                                  data-toggle="tooltip" data-placement="top" title=""
                                                                  data-container="body" data-animation="true"
                                                                  data-html="true"
                                                                  data-original-title="<small>Phí dịch vụ nhằm hỗ trợ KevinOTO duy trì nền tảng ứng dụng và các hoạt động chăm sóc khách hàng một cách tốt nhất.</small>"></i>
                                                    <span class="float-right"><span
                                                            class="font-weight-bold"><span
                                                                id="price_service"></span> </span> / ngày</span>
                                                </span>
                                                    <br>
                                                    <span>
                                                    Phí bảo hiểm<i class="mdi mdi-information-outline"
                                                                   data-toggle="tooltip" data-placement="top" title=""
                                                                   data-container="body" data-animation="true"
                                                                   data-html="true"
                                                                   data-original-title="<small>Chuyến đi của bạn được mua gói bảo hiểm vật chất xe ô tô từ nhà bảo hiểm MIC. Trường hơp có sự cố ngoài ý muốn (trong phạm vi bảo hiểm), số tiền bạn thanh toán tối đa là 2,000,000VND/vụ.</small>"></i>
                                                    <span class="float-right"><span
                                                            class="font-weight-bold"><span
                                                                id="price_insure"></span> </span> / ngày</span>
                                                </span>
                                                    <hr/>
                                                    <span>
                                                    Tổng phí thuê xe
                                                    <span class="float-right font-weight-bold"><span id="price"></span> x <span
                                                            id="total-date"></span> ngày</span>
                                                </span>
                                                    <hr/>
                                                    <span class="font-weight-bold">
                                                    Tổng cộng
                                                    <span class="float-right">
                                                        <input type="number" name="total_price" id="total-price"
                                                               class="form-control"
                                                               hidden>
                                                        <span id="total-price-html"></span>đ
                                                    </span>
                                                </span>
                                                </div>
                                                <div class="col-8 ml-auto mr-auto">
                                                    <div class="text-center">
                                                        <button class="btn btn-success justify-content-center">ĐẶT XE
                                                        </button>
                                                    </div>
                                                </div>
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
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/pages/demo.toastr.js')}}"></script>
    <script type="text/javascript">
        function getDateDiff() {
            let date_start = new Date($('#date_start').val());
            let date_end = new Date($('#date_end').val());
            let date_diff = new Date(date_end - date_start);
            return date_diff / 1000 / 60 / 60 / 24;
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
                        $("#address2").html(each.address2);
                        $("#slot").html(each.slot);
                        $("#fuel").html(each.fuel ? "Dầu" : "Xăng");
                        $("#transmission").html(each.transmission ? "Số tự động" : "Số sàn");
                        $("#fuel_comsumpiton").html(each.fuel_comsumpiton);
                        $("#description").html(each.description);
                        $(".price_1_day").html(each.price_1_day);
                        $("#price_insure").html(each.price_insure);
                        $("#price_service").html(each.price_service);
                        let price = (each.price_1_day * 1000) + each.price_insure + each.price_service
                        $("#price").html(price);
                        $("#total-date").html(getDateDiff());
                        $("#total-price-html").html(getDateDiff()* price);
                        $("#total-price").val(getDateDiff() * price);
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

        function modalEachCar(carId) {
            let route = '{{route('user.bill.store')}}/' + carId;
            $('#form-each-car').prop('action', route);
            $('#form-each-car').prop('method', 'POST');
            $('.carousel-indicators').empty();
            $('.carousel-inner').empty();
            carShow(carId);
        }

        $(document).ready(async function () {
            $("#modal-each-car").on('hide.bs.modal', function () {
                $('#form-each-car').prop('action', '');
                $('#form-each-car').prop('method', '');
                // alert('The modal is about to be hidden.');
            });

            $("#form-list-car").validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'GET',
                        dataType: 'json',
                        data: $(form).serialize(),
                        success: function (response) {
                            location.reload();
                        },
                        error: function (response) {
                            const errors = Object.values(response.responseJSON.errors);
                            let string = '<ul>';
                            errors.forEach(function (each) {
                                each.forEach(function (error) {
                                    string += `<li>${error}</li>`;
                                });
                            });
                            string += '</ul>';
                            notifyError(string);
                        },
                    });
                }
            });
        });
    </script>
@endpush

