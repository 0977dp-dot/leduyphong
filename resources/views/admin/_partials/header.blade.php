<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">

        <span class="navbar-brand">
            Admin Panel
        </span>


        <div class="d-flex align-items-center gap-3">

            <span>
                Xin chào
                <strong>{{ Auth::user()->fullname }}</strong>
            </span>


            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button class="btn btn-link">
                    Đăng xuất
                </button>

            </form>

        </div>

    </div>
</nav>