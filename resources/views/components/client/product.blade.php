<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative card-hover">
    {{-- Badge Giảm giá --}}
    @if ($product->pricediscount > 0 && $product->price > 0)
        @php
            $percent = round((($product->price - $product->pricediscount) / $product->price) * 100);
        @endphp
        <span class="position-absolute top-0 start-0 bg-danger text-white fs-7 fw-bold px-2 py-1 m-2 rounded-2 z-1">
            -{{ $percent }}%
        </span>
    @endif

    {{-- Hình ảnh --}}
    <div class="position-relative overflow-hidden bg-light" style="height: 190px;">
        <img src="{{ $product->image ? asset('storage/products/'.$product->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
             class="card-img-top w-100 h-100" alt="{{ $product->productname }}"
             style="object-fit: cover; transition: transform 0.3s ease;">
    </div>

    <div class="card-body d-flex flex-column p-3">
        {{-- Tên sản phẩm --}}
        <h6 class="card-title fw-bold text-dark text-truncate mb-2" title="{{ $product->productname }}">
            {{ $product->productname }}
        </h6>

        {{-- Giá --}}
        <div class="mb-3">
            @if ($product->pricediscount > 0)
                <div class="text-danger fw-bold fs-6">
                    {{ number_format($product->pricediscount) }} đ
                </div>
                <small class="text-decoration-line-through text-muted">
                    {{ number_format($product->price) }} đ
                </small>
            @else
                <div class="text-danger fw-bold fs-6">
                    {{ number_format($product->price) }} đ
                </div>
            @endif
        </div>

        {{-- Nút chức năng --}}
        <div class="mt-auto">
            <div class="row g-2">
                <div class="col-6">
                    <a href="{{ route('product.show', ['slug'=>$product->slug]) }}" class="btn btn-outline-primary btn-sm w-100 rounded-3">
                        <i class="bi bi-eye me-1"></i> Xem
                    </a>
                </div>
                <div class="col-6">
                    <button class="btn btn-success btn-sm w-100 rounded-3 btn-add-cart"
                            data-product-id="{{ $product->id }}"
                            data-url="{{ route('cart.add') }}">
                        <i class="bi bi-cart-plus me-1"></i> Thêm
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
