<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-2">
    <div class="container">
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Menu --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Trang chủ
                    </a>
                </li>

                {{-- Dropdown Danh mục --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.category') ? 'active text-primary fw-bold' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-grid me-1"></i> Danh mục
                    </a>
                    <ul class="dropdown-menu shadow border-0 rounded-3">
                        @forelse ($categories ?? [] as $item)
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('products.category', ['slug' => $item->slug]) }}">
                                    {{ $item->catename }}
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item py-2 text-muted">Chưa có danh mục</span></li>
                        @endforelse
                    </ul>
                </li>

                {{-- Dropdown Thương hiệu --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.brand') ? 'active text-primary fw-bold' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-tag me-1"></i> Thương hiệu
                    </a>
                    <ul class="dropdown-menu shadow border-0 rounded-3">
                        @forelse ($brands ?? [] as $item)
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('products.brand', ['slug' => $item->slug]) }}">
                                    {{ $item->brandname }}
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item py-2 text-muted">Chưa có thương hiệu</span></li>
                        @endforelse
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.login') }}" target="_blank">
                        <i class="bi bi-person-lock me-1"></i> Trang Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
