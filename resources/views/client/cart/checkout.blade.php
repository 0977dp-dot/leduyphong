@extends('client.layouts.app')

@section('title', 'Thanh toán')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4"><i class="bi bi-credit-card text-success me-2"></i>Thanh toán</h2>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Form thông tin --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Thông tin giao hàng</h5>

                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="fullname"
                                   value="{{ old('fullname') }}"
                                   class="form-control @error('fullname') is-invalid @enderror"
                                   placeholder="Nguyễn Văn A"
                                   required>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="0912 345 678"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="example@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea name="address"
                                      class="form-control @error('address') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Ghi chú (tùy chọn)</label>
                            <textarea name="note"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Ghi chú thêm về đơn hàng (nếu có)...">{{ old('note') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 rounded-3">
                            <i class="bi bi-bag-check me-2"></i> Đặt hàng ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tóm tắt đơn hàng --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Đơn hàng của bạn</h5>

                    <div class="d-flex flex-column gap-3 mb-3">
                    @foreach($cart as $item)
                    @php $subtotal = $item['price'] * $item['quantity']; @endphp
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/products/' . $item['image']) }}"
                                 width="55" height="55"
                                 class="rounded-3 object-fit-cover border flex-shrink-0"
                                 onerror="this.src='https://via.placeholder.com/55'"
                                 alt="{{ $item['productname'] }}">
                            <div class="flex-grow-1 min-width-0">
                                <div class="fw-semibold text-truncate">{{ $item['productname'] }}</div>
                                <small class="text-muted">x{{ $item['quantity'] }} &times; {{ number_format($item['price']) }}&nbsp;đ</small>
                            </div>
                            <div class="fw-bold text-danger flex-shrink-0">
                                {{ number_format($subtotal) }}&nbsp;đ
                            </div>
                        </div>
                    @endforeach
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Tạm tính</span>
                        <span>{{ number_format($total) }}&nbsp;đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Phí vận chuyển</span>
                        <span class="text-success fw-semibold">Miễn phí</span>
                    </div>

                    <div class="d-flex justify-content-between fw-bold fs-5 text-danger border-top pt-3">
                        <span>Tổng cộng</span>
                        <span>{{ number_format($total) }}&nbsp;đ</span>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('cart.index') }}" class="text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection