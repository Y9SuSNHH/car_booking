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
                        <table id="dtHorizontalExample" class="table table-striped table-centered mb-0" cellspacing="0"
                               width="100%">
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
                                        <a href="#" data-target="#popup-image-{{$each->id}}" data-toggle="modal">
                                            <img src="{{ asset('uploads/'.$each->image) }}"
                                                 class="img-fluid img-thumbnail p-1"
                                                 style="max-width: 150px;">
                                        </a>
                                        <div id="popup-image-{{$each->id}}" class="modal fade bd-example-modal-lg"
                                             tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-justify">Ảnh xe</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="carouselExampleIndicators" class="carousel slide"
                                                             data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                <li data-target="#carouselExampleIndicators"
                                                                    data-slide-to="0" class="active"></li>
                                                                <li data-target="#carouselExampleIndicators"
                                                                    data-slide-to="1"></li>
                                                                <li data-target="#carouselExampleIndicators"
                                                                    data-slide-to="2"></li>
                                                            </ol>
                                                            <div class="carousel-inner" role="listbox">
                                                                <div class="carousel-item active">
                                                                    <img src="{{ asset('uploads/'.$each->image) }}"
                                                                         class="d-block img-fluid" alt="First slide">
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img class="d-block img-fluid"
                                                                         src="{{ asset('uploads/'.$each->image) }}"
                                                                         alt="Second slide">
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img class="d-block img-fluid"
                                                                         src="{{ asset('uploads/'.$each->image) }}"
                                                                         alt="Third slide">
                                                                </div>
                                                            </div>
                                                            <a class="carousel-control-prev"
                                                               href="#carouselExampleIndicators" role="button"
                                                               data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                      aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next"
                                                               href="#carouselExampleIndicators" role="button"
                                                               data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                      aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
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
                                    <td>
                                        {{-- {{ route("admin.bills.create", $each->id)}} --}}
                                        @if($each->status === 1)
                                            <button type="button" data-toggle="modal" data-target="#form-create-bill"
                                                    class="btn btn-outline-info">
                                                <i class="uil-money-bill"></i>
                                            </button>
                                            <div id="form-create-bill" class="modal fade bd-example-modal-lg"
                                                 tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Nhập thông tin khách hàng</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route("api.bills.store",$each->id)}}">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="name">Họ và tên</label>
                                                                        <input type="text" class="form-control"
                                                                               id="name" name="name">
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <label>Giới tính</label>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div
                                                                                class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                                                                                <input class="custom-control-input"
                                                                                       type="radio"
                                                                                       name="inlineRadioOptions"
                                                                                       id="genderMale"
                                                                                       value="1" checked>
                                                                                <label class="custom-control-label"
                                                                                       for="genderMale">Nam</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                                                                                <input class="custom-control-input"
                                                                                       type="radio"
                                                                                       name="inlineRadioOptions"
                                                                                       id="genderFemale"
                                                                                       value="0">
                                                                                <label class="custom-control-label"
                                                                                       for="genderFemale">Nữ</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="phone">Số điện
                                                                            thoại</label>
                                                                            <input type="text" id="phone" name="phone" class="form-control"
                                                                                   value="">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="select-address">Địa chỉ</label>
                                                                        <select class="form-control select-address" name="address" id='select-address'></select>
                                                                        @if ($errors->has('address'))
                                                                            <span class="valid-feedback">
                                                                                {{ $errors->first('address') }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-success">Tạo hóa
                                                                    đơn
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($each->status === 2)
                                            <span class="badge badge-warning-lighten">
                                                {{$each->StatusName}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="table-action">
                                        @if($each->status === 2)
                                            <form action="#">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                            </form>
                                        @endif
                                        <form action="#">
                                            <a href="{{ route("admin.cars.edit", $each->id )}}" class="action-icon"> <i
                                                    class="mdi mdi-wrench"></i></a>
                                        </form>
                                        <form action="{{ route('admin.cars.destroy', $each) }}" method="post"
                                              class="action-icon">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link action-icon"><i
                                                    class="dripicons-trash"></i></button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(async function () {
            const response = await fetch('{{asset('locations/index.json')}}');
            let address = await response.json();
            address = Object.entries(address)
            address.forEach(local => {
                let name = local[0]
                let {code, file_path} = local[1];
                let codeTxt = $(".address").text()
                if (code === codeTxt) {
                    $(".address").text(name)
                }
            })
            $('#form-create-bill').modal('show');
            $('#popup-image').modal('show');
            //
            // $.each(address, function (index, each) {
            //     $("#select-address").append(`
            //     <option value='${each.code}' data-path='${each.file_path}}'>
            //         ${index}
            //     </option>`)
            // })
        });
    </script>
@endpush
