<div class="sidebar text-white p-3">

    <h4 class="mb-4">
        <i class="bi bi-speedometer2"></i>
        Admin Panel
    </h4>

    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link text-white"
               href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i>
                Dashboard
            </a>
        </li>

        {{-- MENU QUẢN LÝ --}}
        <li class="nav-item">

            <a class="nav-link text-white"
               data-bs-toggle="collapse"
               href="#menuManage"
               role="button">
                <i class="bi bi-grid"></i>
                Quản lý
                <i class="bi bi-chevron-down float-end"></i>
            </a>

            <div class="collapse show" id="menuManage">

                <ul class="nav flex-column ms-3">

                    <li>
                        <a class="nav-link text-white"
                           href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-tags"></i>
                            Loại sản phẩm
                        </a>
                    </li>

                    <li>
                        <a class="nav-link text-white"
                           href="{{ route('admin.products.index') }}">
                            <i class="bi bi-box-seam"></i>
                            Sản phẩm
                        </a>
                    </li>

                    <li>
                        <a class="nav-link text-white"
                           href="{{ route('admin.brands.index') }}">
                            <i class="bi bi-bookmark"></i>
                            Thương hiệu
                        </a>
                    </li>

                    <li>
                        <a class="nav-link text-white"
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i>
                            Người dùng
                        </a>
                    </li>

                    <li>
                        <a class="nav-link text-white"
                           href="{{ route('admin.posts.index') }}">
                            <i class="bi bi-newspaper"></i>
                            Bài viết
                        </a>
                    </li>

                </ul>

            </div>
        </li>

    </ul>
</div>