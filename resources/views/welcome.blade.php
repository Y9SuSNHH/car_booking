@extends('layout_frontend.master')
@section('content')
    <div class="page-header"
         style="background-image: url('https://images.unsplash.com/photo-1486310662856-32058c639c65?dpr=2&auto=format&fit=crop&w=1500&h=1125&q=80&cs=tinysrgb&crop=');">
        <div class="filter"></div>
        <div class="content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h1 class="title">{{ config('app.name') }}</h1>
                        <h5 class="description">CÙNG BẠN TRÊN MỌI HÀNH TRÌNH</h5>
                        <br>
                    </div>
                    <div class="col-md-8 ml-auto mr-auto">
                        <div id="div-error" class="alert alert-danger d-none"></div>
                    </div>
                    <div class="col-md-10 ml-auto mr-auto">
                        <div class="card card-raised card-form-horizontal no-transition">
                            <div class="card-body">
                                <form action="{{route('api.cars.list')}}" class="form-group"
                                      id="form-list-car">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select-address" name="address"
                                                        id='select-address'></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" id="date_start" name="date_start" class="form-control"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" placeholder="Ngày bắt đầu">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" id="date_end" name="date_end" class="form-control"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" placeholder="Ngày kết thúc">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-danger btn-block"><i
                                                    class="mdi mdi-magnify search-icon"></i> Tìm kiếm
                                            </button>
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
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        function loadAddress() {
            $("#select-address").select2();
            let address = '<option selected value="">Tỉnh/TP</option>';
            @foreach ($addressCars as $each)
                address += `<option>{{$each}}</option>`;
            @endforeach
            $("#select-address").append(address);
        }

        function conditionalDateEnd() {
            let setStartDate = `{{date_format(date_create(now()->addDays()),"d-m-Y")}}`;
            $('#date_start').datepicker('setStartDate', setStartDate);

            $('#date_start').on('change', function () {
                let date_start = $("#date_start").val();
                date_start = date_start.split("-");
                date_start[0] = (+date_start[0]) + (+1);
                let date_end = date_start.join("-");

                $('#date_end').datepicker('setDate','');
                $('#date_end').datepicker('setStartDate', date_end);
            });
        }

        $(document).ready(async function () {
            loadAddress();
            conditionalDateEnd();

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
                        success: function () {
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
