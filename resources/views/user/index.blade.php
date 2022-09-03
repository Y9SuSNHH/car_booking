@extends('layout_frontend.master')
@section('content')
    <div class="section section-blog">
        <div class="container">
            <h3 class="section-title">Xe bạn đã tìm kiếm</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-refine">
                        <div class="card-header">
                            <form action="{{route('api.cars.find')}}" class="form-group"
                                  id="form-list-car">
                                <div class="card-body">
                                    <div class="form-group label-floating">
                                        <select class="form-control select-address" name="address"
                                                id='select-address'></select>
                                    </div>
                                    <div class="form-group label-floating">
                                        <input type="text" name="date_start" id="date_start"
                                               class="form-control date_start"
                                               data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                               data-date-autoclose="true" placeholder="Ngày bắt đầu"
                                               value="{{session()->get('date_start')}}">
                                    </div>
                                    <div class="form-group label-floating">
                                        <input type="text" name="date_end" id="date_end" class="form-control date_end"
                                               data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                               data-date-autoclose="true" placeholder="Ngày kết thúc"
                                               value="{{session()->get('date_end')}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="panel-group" id="accordion" aria-multiselectable="true" aria-expanded="true">
                                <div class="card-header card-collapse" role="tab" id="priceRanger">
                                    <h5 class="mb-0 panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#priceRange"
                                           aria-expanded="true" aria-controls="collapseOne">
                                            Price Range
                                            <i class="nc-icon nc-minimal-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="priceRange" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                                     aria-expanded="true">
                                    <div class="card-body">
                                        <input type="hidden" name="min_salary" value="500" id="input-min-salary">
                                        <input type="hidden" name="max_salary" value="2000" id="input-max-salary">
                                        <span class="pull-left">
                                            <span id="span-min-salary">500</span>K
                                        </span>
                                        <span class="pull-right">
                                            <span id="span-max-salary">2000</span>K
                                        </span>
                                        <div class="clearfix"></div>
                                        <div id="sliderDouble"
                                             class="slider slider-info noUi-target noUi-ltr noUi-horizontal noUi-background">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header card-collapse" role="tab" id="clothingGear">
                                    <h5 class="mb-0 panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#clothing"
                                           aria-expanded="true" aria-controls="collapseSecond">
                                            Clothing
                                            <i class="nc-icon nc-minimal-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="clothing" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                Blazers
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Casual Shirts
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Formal Shirts
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Jeans
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Polos
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Pyjamas
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Shorts
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Trousers
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header card-collapse" role="tab" id="designer">
                                    <h5 class="mb-0 panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion"
                                           href="#refineDesigner" aria-expanded="true" aria-controls="collapseThree">
                                            Designer
                                            <i class="nc-icon nc-minimal-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="refineDesigner" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body">

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                All
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Acne Studio
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Alex Mill
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Alexander McQueen
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Alfred Dunhill
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                AMI
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Berena
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Berluti
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Burberry Prorsum
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Berluti
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Calvin Klein
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Club Monaco
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Dolce &amp; Gabbana
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Gucci
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Kolor
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Lanvin
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Loro Piana
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Massimo Alba
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header card-collapse" role="tab" id="color">
                                    <h5 class="mb-0 panel-title">
                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#colorMaker"
                                           aria-expanded="true" aria-controls="collapseTree">
                                            Colour
                                            <i class="nc-icon nc-minimal-down"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="colorMaker" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                All
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Blue
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Brown
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Gray
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Green
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Neutrals
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                Purple
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach($cars as $car)
                            <x-car :car="$car"></x-car>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="float-right">
                                    {{$cars->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-each-car" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">X</button>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content bg-transparent text-dark shadow-none">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="card">
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
                            <div class="row">
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
                            <div class="row">
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
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form-each-car">
                                        <div class="row">
                                            <div class="col-8 ml-auto mr-auto">
                                                <h3 class="text-center">
                                                    <span class="text-success font-weight-bold"><span
                                                            id="price_1_day_title"></span>K</span>
                                                    <small class="text-muted">/ngày</small>
                                                </h3>
                                            </div>
                                            <div class="col-6 ml-auto mr-auto">
                                                <label class="font-weight-bold">Ngày bắt
                                                    đầu</label>
                                                <input type="text" name="date_start" class="form-control date_start"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" disabled
                                                       value="{{session()->get('date_start')}}">
                                            </div>
                                            <div class="col-6 ml-auto mr-auto">
                                                <label class="font-weight-bold">Ngày kết thúc</label>
                                                <input type="text" name="date_end" class="form-control date_end"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" disabled
                                                       value="{{session()->get('date_end')}}">
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
                                                    <i class="dripicons-location"> <span
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
                                                Đơn giá thuê<i class="mdi mdi-information-outline"
                                                               data-toggle="tooltip" data-placement="top"
                                                               title=""
                                                               data-html="true"
                                                               data-original-title="<small>Giá thuê xe không bao gồm tiền xăng. Khi kết thúc chuyến đi, bạn sẽ đổ xăng về lại mức ban đầu như khi nhận xe.</small>"></i>
                                                <span class="float-right">
                                                    <span id="price_1_day" class="font-weight-bold"></span>/ ngày
                                                </span>
                                                <br>
                                                Phí dịch vụ<i class="mdi mdi-information-outline"
                                                              data-toggle="tooltip" data-placement="top" title=""
                                                              data-container="body" data-animation="true"
                                                              data-html="true"
                                                              data-original-title="<small>Phí dịch vụ nhằm hỗ trợ KevinOTO duy trì nền tảng ứng dụng và các hoạt động chăm sóc khách hàng một cách tốt nhất.</small>"></i>
                                                <span class="float-right">
                                                    <span id="price_service" class="font-weight-bold"></span>/ ngày
                                                </span>
                                                <br>
                                                Phí bảo hiểm<i class="mdi mdi-information-outline"
                                                               data-toggle="tooltip" data-placement="top" title=""
                                                               data-container="body" data-animation="true"
                                                               data-html="true"
                                                               data-original-title="<small>Chuyến đi của bạn được mua gói bảo hiểm vật chất xe ô tô từ nhà bảo hiểm MIC. Trường hơp có sự cố ngoài ý muốn (trong phạm vi bảo hiểm), số tiền bạn thanh toán tối đa là 2,000,000VND/vụ.</small>"></i>
                                                <span class="float-right">
                                                        <span id="price_insure" class="font-weight-bold"></span>/ ngày
                                                    </span>
                                                <hr/>
                                                Tổng phí thuê xe
                                                <span class="float-right font-weight-bold">
                                                        <span id="price"></span> x <span id="total-date"></span> ngày
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
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/pages/demo.toastr.js')}}"></script>
    <script src="{{asset('js/nouislider.js')}}"></script>
    <script type="text/javascript">
        function getDateDiff() {
            let date_start = new Date($('#date_start').val());
            let date_end = new Date($('#date_end').val());
            let date_diff = new Date(date_end - date_start);
            return date_diff / 1000 / 60 / 60 / 24;
        }

        function loadAddress() {
            $("#select-address").select2();
            let address = '<option selected value="">Tỉnh/TP</option>';
            let selected = '';
            @foreach ($addressCars as $each)
                @if ($each === session()->get('address'))
                selected = 'selected';
            @else
                selected = '';
            @endif
                address += "<option " + selected + `>{{$each}}</option>`;

            @endforeach
            $("#select-address").append(address);
        }

        function conditionalDateEnd() {
            let setStartDate = `{{date_format(date_create(now()->addDays()),"d-m-Y")}}`;
            $('.date_start').datepicker('setStartDate', setStartDate);

            $("#select-address").change(function () {
                $("#form-list-car").submit();
            });
            $('#date_start').on('change', function () {
                let date_start = $(".date_start").val();
                date_start = date_start.split("-");
                date_start[0] = (+date_start[0]) + (+1);
                let date_end = date_start.join("-");

                $('#date_end').datepicker('setDate', '');
                $('#date_end').datepicker('setStartDate', date_end);

                if (!$('#date_end').val()) {
                    $('#date_end').change(function () {
                        $("#form-list-car").submit();
                    })
                }
            });
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
                        $("#price_1_day_title").html(each.price_1_day);
                        $("#address2").html(each.address2);
                        $("#slot").html(each.slot);
                        $("#fuel").html(each.fuel ? '<span class="badge badge-default">Dầu</span>' : '<span class="badge badge-success">Xăng</span>');
                        $("#transmission").html(each.transmission ? "Số tự động" : "Số sàn");
                        $("#fuel_comsumpiton").html(each.fuel_comsumpiton);
                        $("#description").html(each.description);
                        $("#price_1_day").html(each.price_1_day + " 000");
                        $("#price_insure").html(each.price_insure);
                        $("#price_service").html(each.price_service);
                        let price = (each.price_1_day * 1000) + each.price_insure + each.price_service
                        $("#price").html(price);
                        $("#total-date").html(getDateDiff());
                        $("#total-price-html").html(getDateDiff() * price);
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
            loadAddress();
            conditionalDateEnd();

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
    <script type="text/javascript">
        $(document).ready(function () {
            const slider2 = document.getElementById('sliderDouble');
            const minSalary = parseInt($("#input-min-salary").val());
            const maxSalary = parseInt($("#input-max-salary").val());
            noUiSlider.create(slider2, {
                start: [minSalary, maxSalary],
                connect: true,
                step: 50,
                range: {
                    'min': [500 - 100],
                    'max': [2000 + 500]
                }
            });
            let val;
            slider2.noUiSlider.on('update', function (values, handle) {
                val = Math.round(values[handle]);
                if (handle) {
                    $('#span-max-salary').text(val);
                    $('#input-max-salary').val(val);
                } else {
                    $('#span-min-salary').text(val);
                    $('#input-min-salary').val(val);
                }
            });
        });
    </script>
@endpush

