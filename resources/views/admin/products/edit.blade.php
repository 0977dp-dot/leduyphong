@extends('admin.layouts.admin')

@section('content')

<div class="container">

    <h3>Sửa sản phẩm</h3>

    @include('admin._partials.errors')

    @if(session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

    @endif

    <form
        action="{{ route('admin.products.update',$product->id) }}"
        method="POST">

        @csrf<div class="mb-3">
            @method('PUT')
            <label class="form-label">

                Tên sản phẩm

            </label>

            <input
                type="text"
                name="productname"
                class="form-control"
                value="{{ old('productname',$product->productname) }}">

        </div>
        <div class="mb-3">

            <label class="form-label">

                Slug

            </label>

            <input
                type="text"
                name="slug"
                class="form-control"
                value="{{ old('slug',$product->slug) }}">

        </div>
        <div class="mb-3">

            <label class="form-label">

                Loại sản phẩm

            </label>

            <select
                name="catid"
                class="form-select">

                @foreach($categories as $category)

                <option
                    value="{{ $category->cateid }}"
                    {{ old('catid',$product->catid)==$category->cateid?'selected':'' }}>

                    {{ $category->catename }}

                </option>

                @endforeach

            </select>

        </div>
        <div class="mb-3">

            <label class="form-label">

                Thương hiệu

            </label>

            <select
                name="brandid"
                class="form-select">

                @foreach($brands as $brand)

                <option
                    value="{{ $brand->id }}"
                    {{ old('brandid',$product->brandid)==$brand->id?'selected':'' }}>

                    {{ $brand->brandname }}

                </option>

                @endforeach

            </select>

        </div><input
            type="number"
            name="price"
            class="form-control"
            value="{{ old('price',$product->price) }}"><input
            type="number"
            name="pricediscount"
            class="form-control"
            value="{{ old('pricediscount',$product->pricediscount) }}"><input
            type="radio"
            class="btn-check"
            name="status"
            id="active"
            value="1"
            {{ old('status',$product->status)==1?'checked':'' }}>

        <label
            class="btn btn-outline-success"
            for="active">

            Hiển thị

        </label>

        <input
            type="radio"
            class="btn-check"
            name="status"
            id="inactive"
            value="0"
            {{ old('status',$product->status)==0?'checked':'' }}>

        <label
            class="btn btn-outline-danger"
            for="inactive">

            Ẩn

        </label><textarea
            name="description"
            rows="4"
            class="form-control">{{ old('description',$product->description) }}</textarea><button
            type="submit"
            class="btn btn-primary">

            Lưu

        </button>

        <a
            href="{{ route('admin.products.index') }}"
            class="btn btn-secondary">

            Quay lại

        </a>

    </form>

</div>

@endsection
