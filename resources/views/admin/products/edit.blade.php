@extends('admin.layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Sửa sản phẩm</h3>
                    <p class="text-muted mb-0">Cập nhật thông tin sản phẩm hiện tại.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>

            @include('admin._partials.errors')
            <x-admin.alert type="danger" :message="session('error')" />

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sản phẩm</label>
                            <input type="text" name="productname" class="form-control" value="{{ old('productname', $product->productname) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Loại sản phẩm</label>
                            <select name="catid" class="form-select">
                                @foreach($categories as $category)
                                <option value="{{ $category->cateid }}" {{ old('catid', $product->catid) == $category->cateid ? 'selected' : '' }}>
                                    {{ $category->catename }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thương hiệu</label>
                            <select name="brandid" class="form-select">
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brandname }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 img-group">
                        <label class="form-label">Hình ảnh chính</label>
                        <input type="file" name="img" class="form-control img-input">
                        <div class="img-preview mt-2">
                            @if ($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}"
                                class="img-thumbnail" width="120">
                            @endif
                        </div>
                        {{-- hiển thị lỗi cho trường img --}}
                        @error('img')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 img-group">
                        <label class="form-label">Hình ảnh phụ</label>
                        <input type="file" name="imgs[]" class="form-control img-input" multiple>
                        <div class="img-preview mt-2">
                            @foreach ($product->images as $image)
                            <div class="d-inline-block position-relative me-2 mb-2 image-item">
                                <img src="{{ asset('storage/products/' . $image->image) }}"
                                    class="img-thumbnail me-2 mb-2" width="100">
                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                    data-product-id="{{ $product->id }}"
                                    data-image-id="{{ $image->id }}">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        {{-- hiển thị lỗi cho trường imgs --}}
                        @error('imgs')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá khuyến mãi</label>
                            <input type="number" name="pricediscount" class="form-control" value="{{ old('pricediscount', $product->pricediscount) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="status" id="active-edit" value="1" {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="active-edit">Hiển thị</label>

                                <input type="radio" class="btn-check" name="status" id="inactive-edit" value="0" {{ old('status', $product->status) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="inactive-edit">Ẩn</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
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

@section('scripts')
<script>
    document.querySelectorAll('.remove-image-btn').forEach(button => {

        button.addEventListener('click', function() {

            // Lấy ID sản phẩm và ID ảnh
            const productId = this.dataset.productId;
            const imageId = this.dataset.imageId;

            // Hỏi xác nhận
            if (!confirm('Bạn có chắc muốn xóa ảnh này?')) return;

            // Gửi request xóa
            fetch(`/admin/products/${productId}/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {
                        // Xóa ảnh khỏi giao diện
                        this.closest('.image-item').remove();
                    }

                    alert(data.message);

                })
                .catch(() => {
                    alert('Xóa ảnh thất bại!');
                });

        });

    });
</script>
@endsection