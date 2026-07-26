<header class="bg-dark text-white py-3 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
            <i class="bi bi-bag-heart-fill fs-3 text-warning"></i>
            <span class="fs-4 fw-bold tracking-tight">Le Phong Shop</span>
        </a>

        <form action="{{ route('products.search') }}" method="GET" class="d-flex my-1" style="max-width: 400px; flex: 1 1 250px;">
            <div class="input-group">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm sản phẩm..." class="form-control border-0 shadow-none">
                <button type="submit" class="btn btn-warning px-3">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light d-flex align-items-center gap-2 rounded-pill px-3 position-relative" id="cart-icon-link">
                <i class="bi bi-cart3 fs-5"></i>
                <span>Giỏ hàng</span>
                @php
                    $cartCount = collect(session('cart', []))->sum('quantity');
                @endphp
                @if($cartCount > 0)
                    <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" id="cart-badge" style="font-size:0.7rem;min-width:20px;">
                        {{ $cartCount }}
                    </span>
                @else
                    <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle d-none" id="cart-badge" style="font-size:0.7rem;min-width:20px;">
                        0
                    </span>
                @endif
            </a>
        </div>
    </div>
</header>
