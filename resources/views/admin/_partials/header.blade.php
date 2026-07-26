<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">

        <span class="navbar-brand">
            Admin Panel
        </span>

        <div class="d-flex gap-3 align-items-center">

            @if(Auth::check())
                <span>
                    Xin chào <strong>{{ Auth::user()->fullname }}</strong>
                </span>

                <a href="{{ route('admin.change-password') }}">
                    Đổi mật khẩu
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Đăng xuất
                    </button>
                </form>
            @else
                <span>
                    Xin chào <strong>Khách</strong>
                </span>

                <a href="{{ route('admin.login') }}" class="btn btn-primary btn-sm">
                    Đăng nhập
                </a>
            @endif

        </div>

    </div>
</nav>