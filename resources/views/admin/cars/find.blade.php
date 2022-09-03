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
                <form action="{{route('api.cars.find')}}" class="form-group"
                      id="form-list-car">
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
                                       data-date-autoclose="true">
                            </div>
                            <div class="col-md-12 ml-auto mr-auto">
                                <label for="date_end">Ngày kết thúc</label>
                                <input type="text" id="date_end" name="date_end" class="form-control"
                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                       data-date-autoclose="true">
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
        function loadAddress() {
            $("#select-address").select2();
            let address = '<option selected value="">Tỉnh/TP</option>';
            @foreach ($addressCars as $each)
                address += `<option>{{$each}}</option>`;
            @endforeach
            $("#select-address").append(address);
        }
        $(document).ready(async function () {
            $('#modal-car-search').modal('show')
            loadAddress();
            conditionalDateEnd();

            $("#form-list-car").validate({
                submitHandler: function (form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'GET',
                        dataType: 'json',
                        data: $(form).serialize(),
                        success: function () {
                            window.location = "{{route('admin.cars.index')}}" + '?' + $(form).serialize();
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
