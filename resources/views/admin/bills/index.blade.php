@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-8">
                        </div>
                        <div class="col-xl-4">
                            <nav class="float-right">
                                <ul class="pagination pagination-rounded mb-0">
                                    <nav>
                                        <ul class="pagination" id="pagination">
                                        </ul>
                                    </nav>
                                </ul>
                            </nav>
                        </div>
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
                                <table id="table-data" class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Người thuê</th>
                                        <th scope="col">Xe thuê</th>
                                        <th scope="col">
                                            Nhân viên bắt đầu <br>
                                            Nhân viên kết thúc
                                        </th>
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
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
