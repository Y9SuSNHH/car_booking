@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cars.update', $each )}}" method="POST" enctype="multipart/form-data"
                          class="form-group">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên xe</label>
                            <input type="text" class="form-control" data-provide="typeahead" name="name" id="name"
                                   value="{{ $each->name }}">
                            @if ($errors->has('name'))
                                <span class="valid-feedback">
                                   {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group form-inline">
                            <div class="form-group col-5">
                                <label>Biển số cũ</label>
                                <img src="{{ asset('uploads/'.$each->image) }}"
                                     class="img-fluid img-thumbnail p-1"
                                     style="max-width: 500px;">
                                <input type="hidden" name="ole_image" value="{{$each->image}}">
                            </div>
                            <div class="form-group col-7">
                                <label for="new_image">Đổi biển số mới</label>
                                <input type="file" class="form-control-file" name="new_image" id="new_image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   value="{{ $each->address }}">
                            @if ($errors->has('address'))
                                <span class="valid-feedback">
                                    {{ $errors->first('address') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="type">Loại xe</label>
                            <select class="form-control select-filter" name="type" id="type">
                                @foreach($types as $key => $value)
                                    <option value="{{ $value }}"
                                            @if ($value === $each->type)
                                            selected
                                        @endif>
                                        {{ $key}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span class="valid-feedback">
                                    {{ $errors->first('type') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="slot">Số ghế ngồi</label>
                            <select name="slot" class="form-control" id="slot">
                                <option value="4" @if($each->slot === 4) selected @endif>4 chỗ</option>
                                <option value="5" @if($each->slot === 5) selected @endif>5 chỗ</option>
                                <option value="7" @if($each->slot === 7) selected @endif>7 chỗ</option>
                            </select>
                            @if ($errors->has('slot'))
                                <span class="valid-feedback">
                                   {{ $errors->first('slot') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="transmission">Truyền động</label>
                            <select name="transmission" class="form-control" id="transmission">
                                <option value="0">Số tự động</option>
                                <option value="1">Số sàn</option>
                            </select>
                            @if ($errors->has('transmission'))
                                <span class="valid-feedback">
                                   {{ $errors->first('transmission') }}
                               </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fuel">Nhiên liệu</label>
                            <select name="fuel" class="form-control" id="fuel">
                                <option value="0">Xăng</option>
                                <option value="1">Dầu</option>
                            </select>
                            @if ($errors->has('fuel'))
                                <span class="valid-feedback">
                                   {{ $errors->first('fuel') }}
                               </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fuel_comsumpiton">Mức tiêu thụ nhiên liệu</label>
                            <input type="number" name="fuel_comsumpiton" id="fuel_comsumpiton"
                                   value="{{ $each->fuel_comsumpiton }}" class="form-control"
                                   placeholder="L/km">
                            @if ($errors->has('fuel_comsumpiton'))
                                <span class="valid-feedback">
                                    {{ $errors->first('fuel_comsumpiton') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" name="description">{{ $each->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="valid-feedback">
                               {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price_1_day">Giá thuê 1 ngày</label>
                            <input type="text" id="price_1_day" name="price_1_day" class="form-control"
                                   value="{{ $each->price_1_day }}">
                            @if ($errors->has('price_1_day'))
                                <span class="valid-feedback">
                               {{ $errors->first('price_1_day') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price_insure">Giá bảo hiểm</label>
                            <input type="text" id="price_insure" name="price_insure" class="form-control"
                                   value="{{ $each->price_insure }}">
                            @if ($errors->has('price_insure'))
                                <span class="valid-feedback">
                               {{ $errors->first('price_insure') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price_service">Giá dịch vụ</label>
                            <input type="text" id="price_insure" name="price_service" class="form-control"
                                   value="{{ $each->price_service }}">
                            @if ($errors->has('price_service'))
                                <span class="valid-feedback">
                               {{ $errors->first('price_service') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="arrStatus">Trạng thái</label>
                            <select class="form-control" name="status" id="arrStatus">
                                @foreach($arrStatus as $keyStatus => $valueStatus)
                                    <option value="{{ $valueStatus }}"
                                            @if ($valueStatus === $each->status)
                                            selected
                                        @endif>
                                        {{ $keyStatus}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('status'))
                                <span class="valid-feedback">
                                   {{ $errors->first('status') }}
                               </span>
                            @endif
                        </div>
                        <button class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
