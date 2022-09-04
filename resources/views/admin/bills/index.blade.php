@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <form class="form-horizontal form-inline" id="form-filter">
                            <div class="form-group col-md-4">
                                <label for="select-name-user">Tên người dùng</label>
                                <select class="form-control select-filter" name="name_user" id='select-name-user'>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="select-name-car">Tên xe</label>
                                <select class="form-control select-filter" name="name_user" id='select-name-car'>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
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
                        </form>
                    </div>
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
                                            </td>
                                            <td>
                                                {{date('d-m-Y', strtotime($each->date_start))}}
                                                <br>
                                                {{date('d-m-Y', strtotime($each->date_end))}}
                                            </td>
                                            <td>
                                                {{ number_format($each->total_price) }} đ
                                            </td>
                                            <td>
                                                <i class="mdi mdi-circle text-{{$each->GenerateStatus}}"></i>
                                                {{$each->StatusName}}
                                            </td>
                                            <td class="table-action">
                                                {{--                                                {{ route("admin.$table.show", $each)}}--}}
                                                <a href="" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil"></i></a>
                                                @if(auth()->user()->role === \App\Enums\UserRoleEnum::ADMIN)
                                                    {{--                                                    {{ route("admin.$table.destroy", $each)}}"--}}
                                                    <form action="" method="post"
                                                          class="action-icon" style="margin: 0px;padding: 0px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link action-icon" style="border: 0px;"><i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endif
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
                            {{$data->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function loadNames() {
            $("#select-name-user").select2();
            let name = '<option selected value="All">Tất cả</option>';
            let selected = '';
            @foreach($names as $name)
                @if($name === $filter['name_user'])
                selected = 'selected';
            @else
                selected = '';
            @endif
                name += "<option " + selected + `>{{$name}}</option>`;
            @endforeach
            $("#select-name-user").append(name);
        }

        function filter() {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        }

        $(document).ready(async function () {
            loadNames();
            filter();
        });
    </script>
@endpush
