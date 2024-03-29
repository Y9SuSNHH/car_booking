@extends('layout_frontend.master')
@section('content')
    <div class="section section-blog">
        <div class="container">
            <h3 class="section-title">Xe bạn đã tìm kiếm</h3>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-refine">
                        <div class="card-header">
                            <form action="{{route('api.cars.find')}}" method="GET" class="form-group"
                                  id="form-list-car">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group label-floating">
                                        <select class="form-control select-city" name="city"
                                                id='select-city'></select>
                                    </div>
                                    <div class="form-group label-floating">
                                        <input type="text" name="date_start" id="date_start" class="form-control"
                                               data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                               data-date-autoclose="true" placeholder="Ngày bắt đầu"
                                               value="{{ session()->get('find_cars.date_start') }}">
                                    </div>
                                    <div class="form-group label-floating">
                                        <input type="text" name="date_end" id="date_end" class="form-control"
                                               data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                               data-date-autoclose="true" placeholder="Ngày kết thúc"
                                               value="{{ session()->get('find_cars.date_end') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
{{--                        <div class="card-body">--}}
{{--                            <div class="panel-group" id="accordion" aria-multiselectable="true" aria-expanded="true">--}}
{{--                                <div class="card-header card-collapse" role="tab" id="priceRanger">--}}
{{--                                    <h5 class="mb-0 panel-title">--}}
{{--                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#priceRange"--}}
{{--                                           aria-expanded="true" aria-controls="collapseOne">--}}
{{--                                            Price Range--}}
{{--                                            <i class="nc-icon nc-minimal-down"></i>--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                </div>--}}
{{--                                <div id="priceRange" class="collapse show" role="tabpanel" aria-labelledby="headingOne"--}}
{{--                                     aria-expanded="true">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <input type="hidden" name="min_salary" value="500" id="input-min-salary">--}}
{{--                                        <input type="hidden" name="max_salary" value="2000" id="input-max-salary">--}}
{{--                                        <span class="pull-left">--}}
{{--                                            <span id="span-min-salary">500</span>K--}}
{{--                                        </span>--}}
{{--                                        <span class="pull-right">--}}
{{--                                            <span id="span-max-salary">2000</span>K--}}
{{--                                        </span>--}}
{{--                                        <div class="clearfix"></div>--}}
{{--                                        <div id="sliderDouble"--}}
{{--                                             class="slider slider-info noUi-target noUi-ltr noUi-horizontal noUi-background">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-header card-collapse" role="tab" id="clothingGear">--}}
{{--                                    <h5 class="mb-0 panel-title">--}}
{{--                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#clothing"--}}
{{--                                           aria-expanded="true" aria-controls="collapseSecond">--}}
{{--                                            Clothing--}}
{{--                                            <i class="nc-icon nc-minimal-down"></i>--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                </div>--}}
{{--                                <div id="clothing" class="collapse" role="tabpanel" aria-labelledby="headingOne">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" checked="">--}}
{{--                                                Blazers--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Casual Shirts--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Formal Shirts--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Jeans--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Polos--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Pyjamas--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Shorts--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Trousers--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-header card-collapse" role="tab" id="designer">--}}
{{--                                    <h5 class="mb-0 panel-title">--}}
{{--                                        <a class="" data-toggle="collapse" data-parent="#accordion"--}}
{{--                                           href="#refineDesigner" aria-expanded="true" aria-controls="collapseThree">--}}
{{--                                            Designer--}}
{{--                                            <i class="nc-icon nc-minimal-down"></i>--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                </div>--}}
{{--                                <div id="refineDesigner" class="collapse" role="tabpanel" aria-labelledby="headingOne">--}}
{{--                                    <div class="card-body">--}}

{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" checked="">--}}
{{--                                                All--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Acne Studio--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Alex Mill--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Alexander McQueen--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Alfred Dunhill--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                AMI--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Berena--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Berluti--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Burberry Prorsum--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Berluti--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Calvin Klein--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Club Monaco--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Dolce &amp; Gabbana--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Gucci--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Kolor--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Lanvin--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Loro Piana--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Massimo Alba--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="card-header card-collapse" role="tab" id="color">--}}
{{--                                    <h5 class="mb-0 panel-title">--}}
{{--                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#colorMaker"--}}
{{--                                           aria-expanded="true" aria-controls="collapseTree">--}}
{{--                                            Colour--}}
{{--                                            <i class="nc-icon nc-minimal-down"></i>--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                </div>--}}
{{--                                <div id="colorMaker" class="collapse" role="tabpanel" aria-labelledby="headingOne">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="" checked="">--}}
{{--                                                All--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Blue--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Brown--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Gray--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Green--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Neutrals--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                <input class="form-check-input" type="checkbox" value="">--}}
{{--                                                Purple--}}
{{--                                                <span class="form-check-sign"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($cars as $car)
                            <x-car :car="$car"></x-car>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="float-right">
                            {{$cars->appends(request()->query())->links()}}
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
                        <div class="col-xl-8">
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
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8 ml-auto mr-auto">
                                            <h3 class="text-center">
                                                    <span class="text-success font-weight-bold"><span
                                                            id="price_1_day_title"></span>K</span>
                                                <small class="text-muted">/ngày</small>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 ml-auto mr-auto">
                                            <label class="font-weight-bold">Ngày bắt
                                                đầu</label>
                                            <input type="text" class="form-control" disabled
                                                   value="{{ session()->get('find_cars.date_start') }}">
                                        </div>
                                        <div class="col-sm-6 ml-auto mr-auto">
                                            <label class="font-weight-bold">Ngày kết thúc</label>
                                            <input type="text" class="form-control" disabled
                                                   value="{{ session()->get('find_cars.date_end') }}">
                                        </div>
                                    </div>
                                    <div class="row pt-2 mt-2 bg-warning">
                                        <div class="col-7">
                                            <div class="grid-container">
                                                <small>
                                                    <span class="float-left">Thời gian nhận xe</span>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="grid-container">
                                                <small>
                                                    <span class="float-right">05:00-22:00</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pb-2 mb-2 bg-warning">
                                        <div class="col-7">
                                            <div class="grid-container">
                                                <small>
                                                    <span class="float-left">Thời gian trả xe</span>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="grid-container">
                                                <small>
                                                    <span class="float-right">17:00-21:00 </span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Địa điểm nhận xe</strong>
                                            <h6>
                                                <i class="dripicons-location"> <span
                                                        id="district"></span></i>
                                            </h6>
                                            <small class="text-muted">Không hỗ trợ giao nhận xe tận nơi. Địa chỉ
                                                cụ
                                                thể sẽ được hiển thị sau khi đặt cọc</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Giới hạn số km</strong><br>
                                            <span>
                                                <small>Tối đa<strong>300</strong>km/ngày. Phí<strong>2K</strong>
                                                    /km vượt giới hạn.
                                                </small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Bảo hiểm</strong><br>
                                            <span>
                                                    <small>Chuyến đi được bảo hiểm bởi MIC Tìm hiểu thêm</small>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 ml-auto mr-auto">
                                            <strong>Chi tiết giá</strong><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="grid-container">
                                                    <span class="float-left">Đơn giá thuê
                                                    <i class="mdi mdi-information-outline" data-toggle="tooltip"
                                                       data-placement="top" title="" data-html="true"
                                                       data-original-title="<small>Giá thuê xe không bao gồm tiền
                                                       xăng. Khi kết thúc chuyến đi, bạn sẽ đổ xăng về lại mức ban
                                                       đầu như khi nhận xe.</small>"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="grid-container">
                                                <span class="float-right">
                                                    <span id="price_1_day" class="font-weight-bold"></span>/ ngày
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="grid-container">
                                                <span class="float-left">Phí dịch vụ
                                                <i class="mdi mdi-information-outline"
                                                   data-toggle="tooltip" data-placement="top" title="Phí dịch vụ nhằm hỗ trợ KevinOTO duy
                                                       trì nền tảng ứng dụng và các hoạt động chăm sóc khách hàng một
                                                       cách tốt nhất."></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="grid-container">
                                                <span class="float-right">
                                                    <span id="price_service" class="font-weight-bold"></span>/ ngày
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="grid-container">
                                                Phí bảo hiểm
                                                <i class="mdi mdi-information-outline"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-container="body" data-animation="true" data-html="true"
                                                   data-original-title="
                                                       <small>Chuyến đi của bạn được mua gói bảo hiểm vật chất xe ô tô
                                                       từ nhà bảo hiểm MIC. Trường hơp có sự cố ngoài ý muốn (trong phạm
                                                        vi bảo hiểm), số tiền bạn thanh toán tối đa là 2,000,000VND/vụ.
                                                        </small>"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="grid-container">
                                                    <span class="float-right">
                                                        <span id="price_insure" class="font-weight-bold"></span>/ ngày
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="grid-container">
                                                Tổng phí thuê xe
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="grid-container">
                                                <span class="float-right font-weight-bold">
                                                    <span id="price"></span> x <span id="total-date"></span> ngày
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row font-weight-bold">
                                        <div class="col-sm-4">
                                            <div class="grid-container">
                                                Tổng tiền
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="grid-container">
                                                <span class="float-right">
                                                    <span id="total-price"></span> đ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="form-bills-store" class="form-horizontal">
                                                @csrf
                                                <div class="text-center">
                                                    <button class="btn btn-success">ĐẶT XE
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
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
                                                        Trân trọng cảm ơn, chúc quý khách hàng có những chuyến đi tuyệt vời!
                                                </span>
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
    <div id="alert-user-index" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h3 text-warning"></i>
                        <h4 class="mt-2" id="error-bills-store"></h4>
                        <form action="{{route('user.index')}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning my-2">Điền
                                thông tin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/nouislider.js')}}"></script>
    <script type="text/javascript">
        function changeDateType(date) {
            let new_date = date.split('-');
            let day = new_date[0];
            let month = new_date[1];
            let year = new_date[2];
            return month + "/" + day + "/" + year;
        }

        function getDateDiff() {
            let date_start = changeDateType($("#date_start").val());
            let date_end = changeDateType($("#date_end").val());

            date_start = new Date(date_start);
            date_end = new Date(date_end);
            let date_diff = new Date(date_end - date_start);
            return date_diff / 1000 / 60 / 60 / 24;
        }

        function loadCity() {
            $("#select-city").select2();
            let city = '<option selected value="">Tỉnh/TP</option>';
            let selected = '';
            @foreach ($cities as $each)
                @if ($each === session()->get('find_cars.city'))
                selected = 'selected';
            @else
                selected = '';
            @endif
                city += "<option " + selected + `>{{$each}}</option>`;

            @endforeach
            $("#select-city").append(city);
        }

        function setStartDateEnd() {
            let setStartDateEnd = $('#date_start').val();
            setStartDateEnd = setStartDateEnd.split("-");
            setStartDateEnd[0] = (+setStartDateEnd[0]) + (+1);
            setStartDateEnd = setStartDateEnd.join("-");

            $('#date_end').datepicker('setStartDate', setStartDateEnd);
        }

        function loadDate() {
            const date_start = $('#date_start');

            let setStartDateStart = `{{date_format(date_create(now()->addDays()),"d-m-Y")}}`;
            date_start.datepicker('setStartDate', setStartDateStart);
            setStartDateEnd();

            $("#select-city").change(function () {
                $("#form-list-car").submit();
            });
            $("#date_end").change(function () {
                if ($(this).val()) {
                    $("#form-list-car").submit();
                }
            });
            date_start.on('change', function () {
                const date_end = $('#date_end');

                date_end.datepicker('setDate', '');
                setStartDateEnd()
                if (!date_end.val()) {
                    date_end.change(function () {
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
                        console.log(index);
                        li = "<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
                        image = "<div class='carousel-item active'>" +
                            "<img class='d-block img-fluid' src='" + image_url + "'>";
                        $('.carousel-indicators').append(li);
                        $('.carousel-inner').append(image);
                        $("#price_1_day_title").html(each.price_1_day / 1000);
                        $("#district").html(each.district);
                        $("#slot").html(each.slot);
                        $("#fuel").html(each.fuel ? '<span class="badge badge-default">Dầu</span>' : '<span class="badge badge-success">Xăng</span>');
                        $("#transmission").html(each.transmission ? '<span class="badge badge-info">Số tự động</span>' : '<span class="badge badge-dark">Số sàn</span>');
                        $("#fuel_comsumpiton").html(each.fuel_comsumpiton);
                        $("#description").html(each.description);
                        $("#price_1_day").html(crawlPrice(each.price_1_day));
                        $("#price_insure").html(crawlPrice(each.price_insure));
                        $("#price_service").html(crawlPrice(each.price_service));
                        let price = each.price_1_day + each.price_insure + each.price_service;
                        $("#price").html(crawlPrice(price));
                        $("#total-date").html(getDateDiff());
                        let total_price = getDateDiff() * price;
                        $("#total-price").html(crawlPrice(total_price));
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

        function modalEachCar(car) {
            let route = '{{route('api.bills.store')}}/' + car;
            $('#form-bills-store').prop('action', route);
            $('#form-bills-store').prop('method', 'POST');
            $('.carousel-indicators').empty();
            $('.carousel-inner').empty();
            carShow(car);
        }

        function crawlPrice(price) {
            return price.toLocaleString('vi');
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
                            @if(auth()->check())
                            $('#modal-each-car').modal('hide');
                            $("#error-bills-store").html(response.responseJSON.message);
                            $('#alert-user-index').modal('show');
                            @else
                            let route = '{{route('signin')}}';
                            window.location.assign(route);
                            @endif
                        },
                    });
                }
            });
        }

        function findCarValidation() {
            let validation = '<ul>';
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                validation += ` < li > {{ $error }} < /li>`;
            @endforeach
                @endif
                validation += `</ul>`;
            notifyError(validation);
        }

        $(document).ready(async function () {
            loadCity();
            loadDate();
            submitFormBillStore();
            $("#modal-each-car").on('hide.bs.modal', function () {
                $('#form-bills-store').prop('action', '');
                $('#form-bills-store').prop('method', '');
            });
            $("#form-list-car").validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'GET',
                        dataType: 'JSON',
                        data: $(form).serialize(),
                        success: function () {
                            $("#div-error").hide();
                            window.location = "{{route('index')}}";
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
                        }
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

