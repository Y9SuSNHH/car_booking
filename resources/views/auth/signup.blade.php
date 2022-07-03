@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('process.signup')}}" method="post">
    @csrf
    @auth
        tên
        <br>
        <input type="text" name="name" value="{{auth()->user()->name}}">
        mail
        <input type="text" name="email" value="{{auth()->user()->email}}">

    @endauth
    @guest
        tên
        <br>
        <input type="text" name="name" value="">
        mail
        <input type="text" name="email" value="">
    @endguest
    mật khẩu
    <input type="password" name="password" value="">
    gender
    <input type="radio" name="gender" value="1" checked>nam
    <input type="radio" value="0" name="gender">nu
    địa chỉ
    <textarea name="address"></textarea>
    sdt
    <input type="text" name="phone" value="">
    <button type="submit">đăng kí</button>

</form>
