<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-3">
        <form action="{{ route('admin.forgotpass.post') }}" class="mx-auto shadow-lg p-4 w-50 bg-light" method="POST">
            @csrf
            <h2>Quên mật khẩu</h2>
            <x-admin.alert></x-admin.alert>

            <div class="mb-3 mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Nhập email đã đăng ký" name="email"
                    value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">Khôi phục mật khẩu</button>
            <div class="mt-3 text-center">
                <a href="{{ route('admin.login') }}">Quay lại đăng nhập</a>
            </div>
        </form>
    </div>
</body>

</html>