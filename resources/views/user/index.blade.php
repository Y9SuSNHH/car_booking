@extends('layout_frontend.master')
@push('css')
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
@endpush
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
                                                @if ($addressCar === session()->get('date_end'))
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
                                       class="form-control" value="{{session()->get('date_end')}}">
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
                            <x-car :car="$car"></x-car>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 ml-auto mr-auto">
                    <button rel="tooltip" class="btn btn-primary btn-round" data-original-title="" title="">
                        Load more...
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(async function () {
            $("#form-list-car").validate({
                // rules: {
                //     name: {
                //         required: true
                //     }
                // },
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'GET',
                        dataType: 'json',
                        data: $(form).serialize(),
                        success: function (response) {
                            $("#div-error").hide();
                            window.location = "{{route('user.index')}}";
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
                            $("#div-error").html(string);
                            $("#div-error").removeClass("d-none").show();
                        },
                    });
                }
            });
        });
    </script>
@endpush

