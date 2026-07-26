@extends('client.layouts.app')

@section('title', 'Thương hiệu: ' . $brand->brandname)

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4"><i class="bi bi-tag-fill text-primary me-2"></i>Thương hiệu: {{ $brand->brandname }}</h3>
    
    @if ($products->count() > 0)
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <x-client.product :product="$product" />
                </div>
            @endforeach
        </div>
        {{-- Phân trang --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center py-5 rounded-4 shadow-sm">
            <i class="bi bi-inbox fs-1 text-secondary mb-3 d-block"></i>
            <h5 class="fw-bold">Chưa có sản phẩm nào thuộc thương hiệu này.</h5>
            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                <i class="bi bi-arrow-left me-1"></i> Quay lại trang chủ
            </a>
        </div>
    @endif
</div>
@endsection
