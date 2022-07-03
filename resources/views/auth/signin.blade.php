<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<form action="{{route('process.signin')}}" method="post">
    @csrf
    email
    <br>
    <input type="text" name="email" value="">
    <br>
    mật khẩu
    <br>
    <input type="password" name="password" value="">
    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Log In
    </button>
</form>
<a href="{{route('auth.redirect','github')}}">Đăng kí github</a>
<a href="{{route('signup')}}">Đăng kí</a>
