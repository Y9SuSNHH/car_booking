@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="form-group col-md-2">
                        <label for="select-car-name">Tên xe</label>
                        <select class="form-control" name="select-car-name" id="select-car-name"></select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="header-title">
                        <div class="form-group col-md-2">
                            <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Thêm xe</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Biển số</th>
                                <th>Tên xe</th>
                                <th>Địa chỉ</th>
                                <th>Loại xe</th>
                                <th>Số chỗ</th>
                                <th>Truyền động</th>
                                <th>Nhiên liệu</th>
                                <th>Nhiên liệu tiêu thụ</th>
                                <th>Giá thuê 1 ngày</th>
                                <th>Phí bảo hiểm</th>
                                <th>Phí dịch vụ</th>
                                <th>Trạng thái</th>
                                <th>Xử lý</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $each)
                                <tr>
                                    <td>{{ $each->id }}</td>
                                    <td>
                                        <a id="image" href="{{ asset('uploads/'.$each->image) }}">
                                            <img src="{{ asset('uploads/'.$each->image) }}"
                                                 class="img-fluid img-thumbnail p-1"
                                                 style="max-width: 150px;">
                                        </a>
                                        <div class="model-fade" hidden>
                                            <div class="model-dialog">
                                                <div class="model-content">
                                                    <img src="" class="img-responsive" id="popup-image"
                                                         style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $each->name }}</td>
                                    <td class="address">{{ $each->address }}</td>
                                    <td>{{ $each->TypeName }}</td>
                                    <td>{{ $each->slot }}</td>
                                    <td>{{ $each->transmission === 0 ? "Số tự động" : "Số sàn" }} </td>
                                    <td>{{ $each->fuel === 0 ? "Xăng" : "Dầu"}}</td>
                                    <td>{{ $each->fuel_comsumpiton." L/km" }}</td>
                                    <td>{{ $each->price_1_day }}</td>
                                    <td>{{ $each->price_insure }}</td>
                                    <td>{{ $each->price_service }}</td>
                                    <td>{{ $each->StatusName}}</td>
                                    <td class="table-action">
                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                class="mdi mdi-eye"></i></a>
                                        <a href="{{ route("admin.cars.edit", $each->id )}}" class="action-icon"> <i
                                                class="mdi mdi-pencil"></i></a>
                                        <form action="{{ route('admin.cars.destroy', $each) }}" method="post"
                                              class="action-icon" style="margin: 0px;padding: 0px;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link action-icon" style="border: 0px;"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(async function () {
            const response = await fetch('{{asset('locations/index.json')}}');
            let address = await response.json();
            address = Object.entries(address)
            address.forEach(local => {
                console.log(local)
                let name = local[0]
                let {code, file_path} = local[1];
                let codeTxt = $(".address").text()
                if (code === codeTxt) {
                    $(".address").text(name)
                }
            })
            $('#image').click(function () {
                event.preventDefault();
                $('.modal img'.attr('src', $(this).attr('href')));
                $('.modal').modal('show');
            });
        });
    </script>
@endpush
