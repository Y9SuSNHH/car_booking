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
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/now-ui-kit.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
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
                                <div class="container-fluid">
                                    <div class="card-body">
                                        <form action="{{route('api.cars.list')}}" class="form-horizontal"
                                              id="form-filter">
                                            <div class="form-row justify-content-center">
                                                <div id="div-error" class="alert alert-danger d-none"></div>
                                            </div>
                                            <div class="form-row justify-content-center">
                                                <div class="col-md-4">
                                                    <div class="form-group select2">
                                                        <label for="select-address"><h5>Tỉnh/TP</h5></label>
                                                        <select class="form-control" data-style="btn btn-info btn-round"
                                                                name="address"
                                                                id='select-address'></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group select2">
                                                        <label for="select-address2"><h5>Quận/Huyện </h5></label>
                                                        <select class="form-control select-address2" name="address2"
                                                                id='select-address2'></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row justify-content-center">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="date_start"><h5>Ngày bắt đầu</h5></label>
                                                        <input type="text" name="date_start" id="date_start"
                                                               class="form-control date" data-toggle="date-picker"
                                                               data-single-date-picker="true">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="date_end"><h5>Ngày kết thúc</h5></label>
                                                        <input type="text" name="date_end" id="date_end"
                                                               class="form-control date" data-toggle="date-picker"
                                                               data-single-date-picker="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
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
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript">
    async function loadDistrict(parent) {
        $("#select-address2").empty();
        const path = $("#select-address option:selected").data('path');
        const response = await fetch('{{ asset('locations/') }}' + path);
        const address2 = await response.json();
        $.each(address2.district, function (index, each) {
            $("#select-address2").append(`
                        <option>
                            ${each.pre} ${each.name}
                        </option>`);
        })
    }

    $(document).ready(async function () {
        $("#select-address").select2();
        const response = await fetch('{{asset('locations/index.json')}}');
        const address = await response.json();
        $.each(address, function (index, each) {
            $("#select-address").append(`
                <option value='${each.code}' data-path='${each.file_path}'>
                    ${index}
                </option>`);
        })

        $("#select-address").change(function () {
            loadDistrict();
        });
        $("#select-address2").select2();
        await loadDistrict();


        $("#form-filter").validate({
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
                        window.location  = "{{route('user.index')}}";
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
