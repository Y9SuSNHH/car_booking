<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Thêm xe</a>
<table class="table table-bordered border-primary">
      <tr>
            <th>Mã xe</th>
            <th>Tên xe</th>
            <th>Ảnh</th>
            <th>Nhãn hiệu</th>
            <th>Địa chỉ</th>
            <th>Loại xe</th>
            <th>Số ghế ngồi</th>
            <th>Truyền động</th>
            <th>Nhiên liệu</th>
            <th>Mức tiêu thụ nhiên liệu</th>
            <th>Mô tả</th>
            <th>Đơn giá thuê 1 ngày</th>
            <th>Phí bảo hiểm</th>
            <th>Phí dịch vụ</th>
            <th>Trạng thái</th>
            <th>Slug</th>
            <th>Sửa</th>
            <th>Xoá</th>

      </tr>

      @foreach ($data as $each)
      <tr>
            <td>{{ $each->id }}</td>
            <td>{{ $each->name }}</td>
            <td><img src ="{{ asset('uploads/'.$each->image) }} " width="200" height="100"></td>
            <td>{{ $each->brand }}</td>
            <td>{{ $each->address }}</td>
            <td>{{ $each->type }}</td>
            <td>{{ $each->slot }}</td>
            <td>{{ $each->transmission === 0 ? "Số tự động" : "Số sàn" }} </td>
            <td>{{ $each->fuel === 0 ? "Xăng" : "Dầu"}}</td>
            <td>{{ $each->fuel_comsumpiton."L/Km" }}</td>
            <td>{{ $each->description }}</td>
            <td>{{ $each->price_1_day }}</td>
            <td>{{ $each->price_insure }}</td>
            <td>{{ $each->price_service }}</td>
            <td>{{ $each->status === 0 ? "Sẵn sàng" : "Bảo trì" }}</td>
            <td>{{ $each->slug }}</td>
            <td>
<<<<<<< Updated upstream
                <a href="{{ route("admin.cars.edit", $each )}}" class="btn btn-success">Sửa</a>
            </td>
            <td>
                <form action="{{ route("admin.cars.destroy", $each) }}" method="post">
=======
                <a href="{{ route('admin.cars.edit', $each )}}" class="btn btn-success">Sửa</a>
            </td>
            <td>
                <form action="{{ route('admin.cars.destroy', $each) }}" method="post">
>>>>>>> Stashed changes
                    @csrf
                    @method('DELETE')
                   <button class="btn btn-danger">Xoá</button>
                </form>
            </td>

      </tr>
      @endforeach

</table>










<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
