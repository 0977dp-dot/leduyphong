@extends('client.layouts.app')
@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Kết quả tìm kiếm cho: "{{ $keyword }}"</h3>

    @if ($products->count() > 0)
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <x-client.product :product="$product" />
                </div>
            @endforeach
        </div>

        {{-- Phân trang --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->appends(['q' => $keyword])->links() }}
        </div>
    @else
        <div class="alert alert-warning">
            Không tìm thấy sản phẩm phù hợp với từ khóa "{{ $keyword }}".
        </div>
    @endif
</div>
@endsection
