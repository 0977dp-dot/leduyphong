@extends('client.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4"><i class="bi bi-cart3 text-primary me-2"></i>Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cart) > 0)

    {{-- Form cập nhật (ngoài table, dùng html5 form attribute) --}}
    <form id="cart-update-form" action="{{ route('cart.update') }}" method="POST">
        @csrf
    </form>

    <div class="row g-4">

        {{-- Bảng giỏ hàng --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3" style="width:90px">Ảnh</th>
                                    <th class="py-3">Sản phẩm</th>
                                    <th class="py-3 text-center">Đơn giá</th>
                                    <th class="py-3 text-center" style="width:140px">Số lượng</th>
                                    <th class="py-3 text-center">Thành tiền</th>
                                    <th class="py-3 text-center pe-4" style="width:70px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $productId => $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr class="border-top">
                                <td class="ps-4 py-3">
                                    <img src="{{ asset('storage/products/' . $item['image']) }}"
                                         width="65" height="65"
                                         class="rounded-3 object-fit-cover border"
                                         onerror="this.src='https://via.placeholder.com/65'"
                                         alt="{{ $item['productname'] }}">
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('product.show', $item['slug']) }}"
                                       class="fw-semibold text-dark text-decoration-none">
                                        {{ $item['productname'] }}
                                    </a>
                                </td>
                                <td class="py-3 text-center text-muted">
                                    {{ number_format($item['price']) }}&nbsp;đ
                                </td>
                                <td class="py-3 text-center">
                                    <input
                                        type="number"
                                        form="cart-update-form"
                                        name="quantity[{{ $productId }}]"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        max="99"
                                        class="form-control form-control-sm text-center"
                                        style="width:80px;margin:auto">
                                </td>
                                <td class="py-3 text-center fw-bold text-danger">
                                    {{ number_format($subtotal) }}&nbsp;đ
                                </td>
                                <td class="py-3 text-center pe-4">
                                    <form action="{{ route('cart.remove', $productId) }}" method="POST"
                                          onsubmit="return confirm('Xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm rounded-circle"
                                                title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Nút cập nhật --}}
            <div class="mt-3">
                <button type="submit" form="cart-update-form" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-repeat me-1"></i> Cập nhật giỏ hàng
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-arrow-left me-1"></i> Tiếp tục mua sắm
                </a>
            </div>
        </div>

        {{-- Tóm tắt đơn hàng --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Tóm tắt đơn hàng</h5>

                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Tạm tính ({{ collect($cart)->sum('quantity') }} sản phẩm)</span>
                        <span>{{ number_format($total) }}&nbsp;đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Phí vận chuyển</span>
                        <span class="text-success fw-semibold">Miễn phí</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Tổng cộng</span>
                        <span class="text-danger">{{ number_format($total) }}&nbsp;đ</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-success w-100 py-2 fw-bold rounded-3">
                        <i class="bi bi-credit-card me-2"></i> Tiến hành thanh toán
                    </a>
                </div>
            </div>
        </div>

    </div>

    @else

        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <i class="bi bi-cart-x text-secondary" style="font-size:4rem"></i>
            <h4 class="fw-bold mt-3">Giỏ hàng của bạn đang trống!</h4>
            <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm.</p>
            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold">
                <i class="bi bi-arrow-left me-2"></i> Mua sắm ngay
            </a>
        </div>

    @endif

</div>

@endsection