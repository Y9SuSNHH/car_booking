@extends('layout_backend.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('user') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="form-horizontal form-inline" id="form-filter">
                        <div class="form-group col-md-3">
                            <label for="select-name">Tên</label>
                            <select class="form-control select-filter" name="name"
                                    id='select-name'></select>
                        </div>
                        {{--                        <div class="form-group col-md-3">--}}
                        {{--                            <label for="select-status">Trạng thái giấy tờ</label>--}}
                        {{--                            <select class="form-control select-filter" name="status"--}}
                        {{--                                    id='select-status'>--}}
                        {{--                                <option value="All" selected>Tất cả</option>--}}
                        {{--                                @foreach($statusImage as $key => $value)--}}
                        {{--                                    <option value="{{$key}}"--}}
                        {{--                                            @if((string)$key === $search['filter']['status'])--}}
                        {{--                                                selected--}}
                        {{--                                    @endif>{{$value}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                    </form>
                </div>
                <div class="card-body">
                    <div class="header-title">
                        <div class="row text-lowercase">
                            <div class="col-md-2">
                                <i class="mdi mdi-circle text-danger"></i>
                                {{\App\Enums\FileStatusEnum::getValueByKey(\App\Enums\FileStatusEnum::NO_PHOTO)}}
                            </div>
                            <div class="col-md-2">
                                <i class="mdi mdi-circle text-warning"></i>
                                {{\App\Enums\FileStatusEnum::getValueByKey(\App\Enums\FileStatusEnum::PENDING)}}
                            </div>
                            <div class="col-md-2">
                                <i class="mdi mdi-circle text-success"></i>
                                {{\App\Enums\FileStatusEnum::getValueByKey(\App\Enums\FileStatusEnum::APPROVED)}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <table class="table table-striped table-centered mb-0" id="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Thông tin</th>
                                <th>CMND</th>
                                <th>GPLX</th>
                                <th>Xử lý</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $each)
                                <tr>
                                    <td>
                                        {{$each->id}}
                                    </td>
                                    <td>{{$each->name}} - {{$each->GenderName}}
                                        <br>
                                        <a href="tel:{{$each->phone}}">
                                            {{$each->phone}}
                                        </a>
                                        <br>
                                        <a href="mailto:{{$each->email}}">
                                            {{$each->email}}
                                        </a>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle text-{{$each->FileIdentity}}"></i>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle text-{{$each->FileLicenseCar}}"></i>
                                    </td>
                                    <td class="table-action">
                                        @if ($each->FileIdentity !== 'danger' || $each->FileLicenseCar !== 'danger')
                                            <a href="#" class="action-icon" data-toggle="modal"
                                               data-target="#modalImage" onclick="userImageShow({{$each->id}})">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route("$role.$table.edit", $each->id)}}" class="action-icon"> <i
                                                class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <nav class="float-right">
                        <ul class="pagination pagination-rounded mb-0">
                            {{$data->appends(request()->query())->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row d-none" id="identity-show">
                                <div class="col-md-12">
                                    <h5>Căn cước công dân</h5>
                                    <input type="checkbox" id="identity-switch" data-switch="success" checked/>
                                    <label for="identity-switch" data-on-label="Yes" data-off-label="No"></label>
                                </div>
                                <div class="col-md-12">
                                    <div id="identity" class="carousel slide carousel-fade" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block img-fluid" id="identity_front" src=""
                                                     alt="Mặt trước">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block img-fluid" id="identity_back" src="" alt="Mặt sau">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#identity" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Trước</span>
                                        </a>
                                        <a class="carousel-control-next" href="#identity" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Sau</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row d-none" id="license-car-show">
                                <div class="col-md-12">
                                    <h5>Giấy phép lái xe</h5>
                                    <input type="checkbox" id="license-car-switch" data-switch="success" checked/>
                                    <label for="license-car-switch" data-on-label="Yes" data-off-label="No"></label>
                                </div>
                                <div class="col-md-12">
                                    <div id="license-car" class="carousel slide carousel-fade" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block img-fluid" id="license_car_front" src=""
                                                     alt="Mặt trước">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block img-fluid" id="license_car_back" src=""
                                                     alt="Mặt sau">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#license-car" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Trước</span>
                                        </a>
                                        <a class="carousel-control-next" href="#license-car" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Sau</span>
                                        </a>
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
    <script type="text/javascript">
        function userImageShow(user) {
            $.ajax({
                url: '{{ route('api.users.show.image') }}' + '/' + user,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let identity = 0, license_car = 0;
                    $.each(response.data, function (index, each) {
                        let link = `{{asset('storage')}}` + '/' + each.link;
                        if (each.type === {{\App\Enums\FileTypeEnum::IDENTITY_FRONT}}) {
                            $("#identity-show").removeClass("d-none").show()
                            $("#identity-switch").attr("data-id", each.table_id)
                            $("#identity_front").attr("src", link);
                            if (each.status === {{\App\Enums\FileStatusEnum::APPROVED}}) {
                                identity++;
                            }
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::IDENTITY_BACK}}) {
                            $("#identity_back").attr("src", link);
                            if (each.status === {{\App\Enums\FileStatusEnum::APPROVED}}) {
                                identity++;
                            }
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::LICENSE_CAR_FRONT}}) {
                            $("#license-car-show").removeClass("d-none").show()
                            $("#license-car-switch").attr("data-id", each.table_id)
                            $("#license_car_front").attr("src", link);
                            if (each.status === {{\App\Enums\FileStatusEnum::APPROVED}}) {
                                license_car++;
                            }
                        }
                        if (each.type === {{\App\Enums\FileTypeEnum::LICENSE_CAR_BACK}}) {
                            $("#license_car_back").attr("src", link);
                            if (each.status === {{\App\Enums\FileStatusEnum::APPROVED}}) {
                                license_car++;
                            }
                        }
                    })
                    if (identity === 2) {
                        $("#identity-switch").prop('checked', true);
                    } else {
                        $("#identity-switch").prop('checked', false);
                    }
                    if (license_car === 2) {
                        $("#license-car-switch").prop('checked', true);
                    } else {
                        $("#license-car-switch").prop('checked', false);
                    }
                },
                error: function (response) {
                }
            });
        }

        function updateIdentityStatus() {
            $('#identity-switch').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let user = $(this).data('id');
                $.ajax({
                    url: `{{route('api.users.identity.status.update')}}`,
                    type: "GET",
                    dataType: "json",
                    data: {'status': status, 'user': user},
                    success: function (response) {
                        $('#table').load(location.href + " #table");
                        notifySuccess(response.message);
                    }
                });
            })
        }

        function updateLicenseCarStatus() {
            $('#license-car-switch').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let user = $(this).data('id');
                $.ajax({
                    url: `{{route('api.users.license.car.status.update')}}`,
                    type: "GET",
                    dataType: "json",
                    data: {'status': status, 'user': user},
                    success: function (response) {
                        $('#table').load(location.href + " #table");
                        notifySuccess(response.message);
                    }
                });
            })
        }

        function loadNames() {
            $("#select-name").select2();
            let name = '<option selected value="All">Tất cả</option>';
            let selected = '';
            @foreach($names as $name)
                @if($name === $search['filter']['name'])
                selected = 'selected';
            @else
                selected = '';
            @endif
                name += "<option " + selected + `>{{$name}}</option>`;
            @endforeach
            $("#select-name").append(name);
        }

        $(document).ready(function () {
            loadNames()
            updateIdentityStatus();
            updateLicenseCarStatus()
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
            $('#modalImage').on('hidden.bs.modal', function () {
                $("#identity_front").attr("src", '');
                $("#identity_back").attr("src", '');
                $("#license_car_front").attr("src", '');
                $("#license_car_back").attr("src", '');
                $("#identity-show").addClass("d-none");
                $("#license-car-show").addClass("d-none");
                $("#identity-switch").attr("data-id", '')
                $("#license-car-switch").attr("data-id", '')
            });
            let string;
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                string = `{{ $error }}`;
            @endforeach
            notifyError(string);
            @endif

        });

    </script>
@endpush
