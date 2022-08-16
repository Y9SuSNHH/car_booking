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
                                    <option selected value="All" class="text-black">Tất cả</option>
                                    @foreach($addressCars as $addressCar)
                                        <option value="{{$addressCar}}" class="text-black"
                                                @if ($addressCar === session()->get('address'))
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
                                       class="form-control" value="{{session()->get('date_start')}}">
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_end">Ngày kết thúc</label>
                                <input type="date" name="date_end" id="date_end"
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mr-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8 ml-auto mr-auto price_1_day">
                                                <h3 class="text-center">
                                                    <span class="text-success font-weight-bold">1234K</span>
                                                    <small class="text-muted">/ngày</small>
                                                </h3>
                                            </div>
                                            <div class="col-6 ml-auto mr-auto">
                                                <label for="date_start" class="font-weight-bold">Ngày bắt đầu</label>
                                                <input type="date" name="date_start" id="date_start"
                                                       min="{{now()->addDays()->toDateString()}}"
                                                       class="form-control" value="{{session()->get('date_start')}}">
                                            </div>
                                            <div class="col-6 ml-auto mr-auto">
                                                <label for="date_end" class="font-weight-bold">Ngày kết thúc</label>
                                                <input type="date" name="date_end" id="date_end"
                                                       min="{{now()->addDays(2)->toDateString()}}"
                                                       class="form-control" value="{{session()->get('date_end')}}">
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
                                                    <i class="now-ui-icons location_compass-05"> Quận Ba Đình</i>
                                                </h6>
                                                <small class="text-muted">Không hỗ trợ giao nhận xe tận nơi. Địa chỉ cụ
                                                    thể
                                                    sẽ được
                                                    hiển thị sau khi đặt cọc</small>
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
                                                            class="font-weight-bold">XXX XXX </span> / ngày</span>
                                                </span>
                                                <br>
                                                <span>
                                                    Phí dịch vụ<i class="mdi mdi-information-outline"
                                                                  data-toggle="tooltip" data-placement="top" title=""
                                                                  data-container="body" data-animation="true"
                                                                  data-html="true"
                                                                  data-original-title="<small>Phí dịch vụ nhằm hỗ trợ KevinOTO duy trì nền tảng ứng dụng và các hoạt động chăm sóc khách hàng một cách tốt nhất.</small>"></i>
                                                    <span class="float-right"><span
                                                            class="font-weight-bold">XXX XXX </span> / ngày</span>
                                                </span>
                                                <br>
                                                <span>
                                                    Phí bảo hiểm<i class="mdi mdi-information-outline"
                                                                   data-toggle="tooltip" data-placement="top" title=""
                                                                   data-container="body" data-animation="true"
                                                                   data-html="true"
                                                                   data-original-title="<small>Chuyến đi của bạn được mua gói bảo hiểm vật chất xe ô tô từ nhà bảo hiểm MIC. Trường hơp có sự cố ngoài ý muốn (trong phạm vi bảo hiểm), số tiền bạn thanh toán tối đa là 2,000,000VND/vụ.</small>"></i>
                                                    <span class="float-right"><span
                                                            class="font-weight-bold">XXX XXX </span> / ngày</span>
                                                </span>
                                                <hr/>
                                                <span>
                                                    Tổng phí thuê xe
                                                    <span class="float-right font-weight-bold">XXX XXX x X ngày</span>
                                                </span>
                                                <hr/>
                                                <span class="font-weight-bold">
                                                    Tổng cộng
                                                    <span class="float-right">XXX XXX đ</span>
                                                </span>
                                            </div>
                                            <div class="col-8 ml-auto mr-auto">
                                                <form id="form-each-car" class="col-12">
                                                    <div class="text-center">
                                                        <button class="btn btn-success justify-content-center">ĐẶT XE
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
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/pages/demo.toastr.js')}}"></script>
    <script type="text/javascript">
        function getImage(carId) {
            $.ajax({
                url: '{{ route('api.cars.each') }}/' + carId,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
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

        function modalEachCar(carId) {
            let route = '{{route('user.bill.store')}}/' + carId;
            $('#form-each-car').prop('action', route);
            $('#form-each-car').prop('method', 'POST');
            $('.carousel-indicators').empty();
            $('.carousel-inner').empty();
            getImage(carId);
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
                            console.log(response)
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

