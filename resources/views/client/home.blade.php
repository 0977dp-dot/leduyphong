@extends('client.layouts.app')

@section('title', 'Trang chủ - Laravel Shop')

@section('content')
{{-- Hero Banner / Welcome --}}
<div class="p-5 mb-4 text-white rounded-4 shadow-sm text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="py-3">
        <h1 class="display-5 fw-bold mb-3">Chào Mừng Đến Với Laravel Shop</h1>
        <p class="fs-5 max-w-700 mx-auto opacity-90">Khám phá các sản phẩm công nghệ đỉnh cao, phụ kiện chính hãng với mức giá ưu đãi nhất!</p>
    </div>
</div>

{{-- Sản phẩm mới --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold m-0 text-dark"><i class="bi bi-stars text-warning me-2"></i>Sản phẩm mới</h3>
</div>
<div class="row g-4 mb-5">
    @forelse ($newProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <x-client.product :product="$product" />
        </div>
    @empty
        <div class="col-12 text-center text-muted py-4">Chưa có sản phẩm mới.</div>
    @endforelse
</div>

{{-- Sản phẩm giảm giá --}}
@if(count($saleProducts) > 0)
<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold m-0 text-dark"><i class="bi bi-lightning-charge-fill text-danger me-2"></i>Sản phẩm giảm giá</h3>
</div>
<div class="row g-4">
    @foreach ($saleProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <x-client.product :product="$product" />
        </div>
    @endforeach
</div>
@endif
@endsection
