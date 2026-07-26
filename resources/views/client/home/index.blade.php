@extends('client.layouts.app')

@section('title', 'Trang chủ')

@section('content')

<h2 class="mb-4">Sản phẩm mới</h2>

<div class="row">

@foreach($newProducts as $product)

<div class="col-md-3 mb-4">

    <div class="card h-100">

        <img src="{{ asset('storage/'.$product->image) }}"
             class="card-img-top"
             height="220">

        <div class="card-body">

            <h5>{{ $product->productname }}</h5>

            <p class="text-danger fw-bold">

                {{ number_format($product->price) }} đ

            </p>

            <a href="{{ route('products.show',$product->slug) }}"
               class="btn btn-primary w-100">

                Xem chi tiết

            </a>

        </div>

    </div>

</div>

@endforeach

</div>

@endsection