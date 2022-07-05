@extends('layout_backend.master')
@section('content')
    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="form-control">
        @csrf
        Tên xe
        <input type="text" name="name" class="form-control">
        @if ($errors->has('name'))
         <span class="error" style="color: red;">
           {{ $errors->first('name') }}
         </span>
        @endif
        <br>
        Ảnh
        <input type="file" name="file_upload" class="form-control">
        @if ($errors->has('image'))
         <span class="error" style="color: red;">
           {{ $errors->first('image') }}
         </span>
        @endif
        <br>
        Địa chỉ
        <input type="text" name="address" class="form-control">
        @if ($errors->has('address'))
         <span class="error" style="color: red;">
           {{ $errors->first('address') }}
         </span>
        @endif
        <br>
        Loại xe
        <input type="text" name="type" class="form-control">
        @if ($errors->has('type'))
         <span class="error" style="color: red;">
           {{ $errors->first('type') }}
         </span>
        @endif
        <br>
        Số ghế ngồi
        <input type="text" name="slot" class="form-control">
        @if ($errors->has('slot'))
         <span class="error" style="color: red;">
           {{ $errors->first('slot') }}
         </span>
        @endif
        <br>
        Truyền động
        <select name="transmission" class="form-control">
            <option value="0">Số tự động</option>
            <option value="1">Số sàn</option>
        </select>
        @if ($errors->has('transmission'))
         <span class="error" style="color: red;">
           {{ $errors->first('transmission') }}
         </span>
        @endif
        <br>
        Nhiên liệu
        <select name="fuel" class="form-control">
            <option value="0">Xăng</option>
            <option value="1">Dầu</option>
        </select>
        @if ($errors->has('fuel'))
         <span class="error" style="color: red;">
           {{ $errors->first('fuel') }}
         </span>
        @endif
        <br>
        Mức tiêu thụ nhiên liệu
        <input type="text" name="fuel_comsumpiton" class="form-control" placeholder="L/km">
        @if ($errors->has('fuel_comsumpiton'))
         <span class="error" style="color: red;">
           {{ $errors->first('fuel_comsumpiton') }}
         </span>
        @endif
        <br>
        <div class="form-floating">
            <label for="motaxe">Mô tả </label>
            <textarea class="form-control" placeholder="Nhập mô tả ở đây.." name="description"></textarea>
        </div>
        @if ($errors->has('description'))
         <span class="error" style="color: red;">
           {{ $errors->first('description') }}
         </span>
        @endif
        <br>
        Giá thuê 1 ngày
        <input type="text" name="price_1_day" class="form-control">
        @if ($errors->has('price_1_day'))
         <span class="error" style="color: red;">
           {{ $errors->first('price_1_day') }}
         </span>
        @endif
        <br>
        Phí bảo hiểm
        <input type="text" name="price_insure" class="form-control">
        @if ($errors->has('price_insure'))
         <span class="error" style="color: red;">
           {{ $errors->first('price_insure') }}
         </span>
        @endif
        <br>
        Phí dịch vụ
        <input type="text" name="price_service" class="form-control">
        @if ($errors->has('price_service'))
         <span class="error" style="color: red;">
           {{ $errors->first('price_service') }}
         </span>
        @endif
        <br>
        Trạng thái
        <select name="status" class="form-control">
            <option value="0">Sẵn sàng</option>
            <option value="1">Đang bảo trì</option>s
        </select>
        @if ($errors->has('status'))
         <span class="error" style="color: red;">
           {{ $errors->first('status') }}
         </span>
        @endif
        <br>
        Slug
        <input type="text" name="slug" class="form-control">
        @if ($errors->has('slug'))
         <span class="error" style="color: red;">
           {{ $errors->first('slug') }}
         </span>
        @endif
        <br>
        <button class="btn btn-primary">Thêm</button>
      </form>
@endsection

