<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Sections - Now UI Kit Pro by Creative Tim </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/now-ui-kit.css')}}" rel="stylesheet"/>
</head>
<body class="sections-page">
<div class="wrapper">
    <div class="cd-section" id="headers">
        <div class="header-2">
            @include('layout_frontend.topbar')
            <div class="page-header header-filter">
                <div class="page-header-image" style="background-image: url('{{asset('bg14.jpg')}}');"></div>
                <div class="content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 ml-auto mr-auto text-center">
                                <h1 class="title">KEVINOTO</h1>
                                <h5 class="description">CÙNG BẠN TRÊN MỌI HÀNH TRÌNH</h5>
                            </div>
                            <div class="col-md-10 ml-auto mr-auto">
                                <div class="card card-raised card-form-horizontal card-plain" data-background-color="">
                                    <div class="card-body">
                                        <form action="{{route('api.cars.list')}}" class="form-group"
                                              id="form-list-car">
                                            <div class="col-md-8 ml-auto mr-auto">
                                                <div id="div-error" class="alert alert-danger d-none"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
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
                                                <div class="col-md-4 form-group">
                                                    <label for="date_start">Ngày bắt đầu</label>
                                                    <input type="date" name="date_start" id="date_start"
                                                           min="{{now()->addDays()->toDateString()}}"
                                                           value="{{session()->get('date_start')}}"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="date_end">Ngày kết thúc</label>
                                                    <input type="date" name="date_end" id="date_end"
                                                           min="{{now()->addDays(2)->toDateString()}}"
                                                           value="{{session()->get('date_end')}}"
                                                           class="form-control">
                                                </div>
                                                <br>
                                                <div class="col-md-3 ml-auto mr-auto">
                                                    <button class="btn btn-success btn-round btn-block">
                                                        Tìm kiếm
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
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/now-ui-kit.js')}}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
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
</body>
</html>
