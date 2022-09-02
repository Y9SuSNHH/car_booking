@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="form-horizontal form-inline" id="form-filter">
                        <div class="form-group col-md-4">
                            <label for="role" class="col-form-label">Role</label>
                            <select class="form-control select-filter" name="role" id="role">
                                <option selected value="All">Tất cả</option>
                                @foreach($roles as $role => $value)
                                    <option value="{{ $value }}"
                                            @if((string)$value === $selectedRole) selected @endif
                                    >
                                        {{ $rolesName[$value] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
                        <div class="form-group col-md-2">
                            <a href="{{ route("admin.$table.create") }}" class="btn btn-success">Thêm</a>
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
                                <th>Role</th>
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
                                        @foreach($each->files as $file)
                                            @if($file->type === 0)
                                                <img src="{{$file->link}}" class="img-fluid img-thumbnail p-2"
                                                     style="max-width: 80px;" alt="CMND">
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($each->files as $file)
                                            @if($file->type === 1)
                                                <img src="{{$file->link}}" class="img-fluid img-thumbnail p-2"
                                                     style="max-width: 80px;" alt="GPLX">
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$each->address}}</td>
                                    <td>{{$each->address2}}</td>
                                    <td>{{$each->RoleName}}</td>
                                    <td class="table-action">
                                        <a href="{{ route("admin.$table.show", $each)}}" class="action-icon"> <i
                                                class="mdi mdi-eye"></i></a>
                                        @if($each->role === 1)
                                            <a href="javascript: void(0);" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                        @endif
                                        @if($each->role !== 0)
                                            <form action="{{ route("admin.$table.destroy", $each)}}" method="post"
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
        $(document).ready(function () {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
        });

    </script>
@endpush
