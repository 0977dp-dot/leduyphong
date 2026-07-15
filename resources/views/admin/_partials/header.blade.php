<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">

        <span class="navbar-brand">
            Admin Panel
        </span>


        <div class="d-flex gap-3">

            <span>
                Xin chào
                <strong>{{ Auth::user()->fullname }}</strong>
            </span>


            <a href="{{ route('admin.change-password') }}">
                Đổi mật khẩu
            </a>


            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit">
                    Đăng xuất
                </button>
            </form>


        </div>

    </div>
</nav>