@extends('layout_backend.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('bills') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="form-group" id="form-filter">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="select-name-user">Tên người dùng</label>
                                <select class="form-control select-filter" name="name_user"
                                        id='select-name-users'>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="select-name-cars">Tên xe</label>
                                <select class="form-control select-filter" name="name_car"
                                        id='select-name-cars'>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="select-status">Trạng thái</label>
                                <select class="form-control select-filter" name="status" id='select-status'>
                                    <option value="All" selected>Tất cả</option>
                                    @foreach($status as $key => $value)
                                        <option value="{{$key}}"
                                                @if((string)$key === $filter['status'])
                                                    selected
                                            @endif>
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <div class="row">
                                    <div class="col-6">
                                        <i class="mdi mdi-circle text-primary"></i> Đặt xe
                                    </div>
                                    <div class="col-6">
                                        <i class="mdi mdi-circle text-warning"></i> Đã giao xe
                                    </div>
                                    <div class="col-6">
                                        <i class="mdi mdi-circle text-success"></i> Hoàn thành
                                    </div>
                                    <div class="col-6">
                                        <i class="mdi mdi-circle text-danger"></i> Quá hạn
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="header-title">
                        <div class="form-group col-md-2">
                        </div>
                    </div>
                    <div class="tab-content" style="overflow-y: auto !important;">
                        <div class="tab-pane show active" id="responsive-preview">
                            <div class="table-responsive">
                                <table id="table-data" class="table table-centered mb-0">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Người thuê</th>
                                        <th scope="col">Xe thuê</th>
                                        <th scope="col">Ngày bắt đầu <br> Ngày kết thúc</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Xử lý</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $each)
                                        <tr>
                                            <td>
                                                {{$each->id}}
                                            </td>
                                            <td>
                                                {{$each->user->name}} - {{$each->user->GenderName}}
                                                <br>
                                                <a href="tel:{{$each->phone}}">
                                                    {{$each->user->phone}}
                                                </a>
                                                <br>
                                                <a href="mailto:{{$each->email}}">
                                                    {{$each->user->email}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$each->car->name}}
                                                <br>
                                                {{$each->car->district}} - {{$each->car->city}}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-info">{{date('d-m-Y', strtotime($each->date_start))}}</span>
                                                <br>
                                                <span
                                                    class="badge badge-info">{{date('d-m-Y', strtotime($each->date_end))}}</span>
                                            </td>
                                            <td>
                                                {{ number_format($each->total_price) }} đ
                                            </td>
                                            <td>
                                                <i class="mdi mdi-circle text-{{$each->GenerateStatus}}"></i>
                                            </td>
                                            <td class="table-action">
                                                <div class="row">
                                                    @if ($each->GenerateStatus === 'danger' && $each->status === \App\Enums\BillStatusEnum::PENDING)
                                                        <a href="{{ route("$role.$table.edit", $each)}}"
                                                           class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    @else
                                                        <a href="{{ route("$role.$table.show",$each->id)}}"
                                                           class="action-icon"><i class="mdi mdi-eye"></i>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->role === \App\Enums\UserRoleEnum::ADMIN)
                                                        <form action="{{ route("$role.$table.destroy",$each->id)}}"
                                                              method="post" class="action-icon" id="form-bills-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link action-icon"
                                                                    style="border: 0px;"><i
                                                                    class="mdi mdi-delete"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
@endsection
@push('js')
    <script type="text/javascript">
        function loadNameUsers() {
            $("#select-name-users").select2();
            let name = '<option selected value="All">Tất cả</option>';
            let selected = '';
            @foreach($nameUsers as $name)
                @if($name === $filter['name_user'])
                selected = 'selected';
            @else
                selected = '';
            @endif
                name += "<option " + selected + `>{{$name}}</option>`;
            @endforeach
            $("#select-name-users").append(name);
        }

        function filter() {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        }

        function loadNameCars() {
            $("#select-name-cars").select2();
            let name = '<option selected value="All">Tất cả</option>';
            let selected = '';
            @foreach($nameCars as $name)
                @if($name === $filter['name_car'])
                selected = 'selected';
            @else
                selected = '';
            @endif
                name += "<option " + selected + `>{{$name}}</option>`;
            @endforeach
            $("#select-name-cars").append(name);
        }

        $(document).ready(async function () {
            loadNameUsers();
            loadNameCars();
            filter();
            @if (session('bills_success_message'))
            notifySuccess('{{ session('bills_success_message') }}');
            @endif
        });
    </script>
@endpush
