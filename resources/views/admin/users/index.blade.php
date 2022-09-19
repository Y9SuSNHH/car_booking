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
                        {{--                        <div class="form-group col-md-4">--}}
                        {{--                            <label for="role" class="col-form-label">Role</label>--}}
                        {{--                            <select class="form-control select-filter" name="role" id="role">--}}
                        {{--                                <option selected value="All">Tất cả</option>--}}
                        {{--                                @foreach($roles as $key => $value)--}}
                        {{--                                    <option value="{{ $key }}"--}}
                        {{--                                            @if((string)$key === $selectedRole) selected @endif--}}
                        {{--                                    >--}}
                        {{--                                        {{ $value }}--}}
                        {{--                                    </option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <div class="form-group col-md-4">
                            <label for="address" class="col-form-label">Tỉnh/TP</label>
                            <select class="form-control select-filter" name="address" id="address">
                                <option selected value="All">Tất cả</option>
                                @foreach($positions as $position)
                                    <option
                                        @if($position === $selectedAddress) selected @endif
                                    >
                                        {{ $position }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address2" class="col-form-label">Quận/Huyện</label>
                            <select class="form-control select-filter" name="address2" id="address2">
                                <option selected value="All">Tất cả</option>
                                @foreach($cities as $city)
                                    <option
                                        @if($city === $selectedAddress2) selected @endif
                                    >
                                        {{ $city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Thông tin</th>
                                <th>CMND</th>
                                <th>GPLX</th>
                                <th>Quận/Huyện</th>
                                <th>Tỉnh/TP</th>
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
                                    <td>{{$each->address2}}</td>
                                    <td>{{$each->address}}</td>
                                    <td class="table-action">
                                        <a href="{{ route("admin.$table.show", $each)}}" class="action-icon"> <i
                                                class="mdi mdi-eye"></i></a>
                                        <a href="{{ route("admin.$table.edit", $each)}}" class="action-icon"> <i
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
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        });

    </script>
@endpush
