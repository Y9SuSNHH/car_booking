<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Thông tin</th>
        <th scope="col">CMND</th>
        <th scope="col">GPLX</th>
        <th scope="col">Address</th>
        <th scope="col">Role</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
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
        </tr>
    @endforeach
    </tbody>
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        {{$data->links()}}
    </ul>
</nav>
