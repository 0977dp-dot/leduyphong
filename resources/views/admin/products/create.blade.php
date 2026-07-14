@extends('admin.layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Thêm sản phẩm</h3>
                    <p class="text-muted mb-0">Vui lòng điền đầy đủ thông tin sản phẩm.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>

            @include('admin._partials.errors')
            <x-admin.alert type="danger" :message="session('error')" />

            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sản phẩm</label>
                            <input type="text" name="productname" class="form-control" value="{{ old('productname') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Loại sản phẩm</label>
                            <select name="catid" class="form-select" required>
                                <option value="">-- Chọn loại sản phẩm --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->cateid }}" {{ old('catid') == $category->cateid ? 'selected' : '' }}>
                                        {{ $category->catename }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thương hiệu</label>
                            <select name="brandid" class="form-select">
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brandid') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brandname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá khuyến mãi</label>
                            <input type="number" name="pricediscount" class="form-control" value="{{ old('pricediscount', 0) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="active">Hiển thị</label>

                                <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status') == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Lưu
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
