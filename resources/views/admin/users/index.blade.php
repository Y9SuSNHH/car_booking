@extends('layout_backend.master')
@section('content')
<table class="table table-striped table-centered mb-0">
    <thead>
    <tr>
        <th>#</th>
        <th>Thông tin</th>
        <th>CMND</th>
        <th>GPLX</th>
        <th>Địa chỉ</th>
        <th>Quyền</th>
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
                @foreach($identity as $id)
                    @if($id->table_id === $each->id)
                        {{$id->link}}
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($license_driver as $license)
                    @if($license->table_id === $each->id)
                        {{$license->link}}
                    @endif
                @endforeach
            </td>
            <td>{{$each->address}}</td>
            <td>{{$each->RoleName}}</td>
            <td class="table-action">
                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        {{$data->links()}}
    </ul>
</nav>
@endsection
