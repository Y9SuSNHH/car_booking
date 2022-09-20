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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10 ml-auto mr-auto">
                        <div class="card card-raised card-form-horizontal no-transition">
                            <div class="card-body">
                                <form action="{{route('index')}}" class="form-group"
                                      id="form-list-car">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control select-city" name="city"
                                                        id='select-city'></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" id="date_start" name="date_start"
                                                       class="form-control"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" placeholder="Ngày bắt đầu"
                                                       value="{{ session()->get('find_cars.date_start') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" id="date_end" name="date_end" class="form-control"
                                                       data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                       data-date-autoclose="true" placeholder="Ngày kết thúc"
                                                       value="{{ session()->get('find_cars.date_end') }}">
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
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
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
            setStartDateEnd()

            date_start.on('change', function () {
                $('#date_end').datepicker('setDate', '');
                setStartDateEnd()
            });
        }

        $(document).ready(async function () {
            loadCity();
            loadDate();
        });


    </script>
@endpush
