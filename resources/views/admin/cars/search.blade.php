@extends('layout_backend.master')
@section('content')
    <div class="modal fade" id="modal-car-search" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tìm xe</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{route('api.cars.list')}}" class="form-group"
                      id="form-cars-list">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="select-address">Tỉnh/TP</label>
                                <select class="form-control select-address" name="address"
                                        id='select-address'></select>
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_start">Ngày bắt đầu</label>
                                <input type="text" id="date_start" name="date_start" class="form-control"
                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                       data-date-autoclose="true"
                                       data-date-start-date="{{date_format(date_create(now()->addDays()),"d-m-Y")}}">
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_end">Ngày kết thúc</label>
                                <input type="text" id="date_end" name="date_end" class="form-control"
                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                       data-date-autoclose="true"
                                       data-date-start-date="{{date_format(date_create(now()->addDays(2)),"d-m-Y")}}">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Tìm xe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(async function () {
            $('#modal-car-search').modal('show')
            $("#select-address").select2();
            @foreach ($addressCars as $each)
            $("#select-address").append(`
            <option>
                {{$each}}
            </option>`);
            @endforeach
            $("#form-cars-list").validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'GET',
                        dataType: 'json',
                        data: $(form).serialize(),
                        success: function () {
                            console.log($(form).serialize());
                            let data = $(form).serialize();
                            let route_car_index = '{{route("admin.cars.index","data")}}'
                            route_car_index = route_car_index.replace('data', data);
                            window.location = route_car_index;
                        },
                        error: function (response) {
                            console.log($(form).serialize());
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
