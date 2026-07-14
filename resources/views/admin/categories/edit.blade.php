@extends('admin.layouts.admin')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Sửa danh mục</h3>
                    <p class="text-muted mb-0">Cập nhật thông tin danh mục hiện tại.</p>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Quay lại</a>
            </div>

            @include('admin._partials.errors')
            <x-admin.alert type="danger" :message="session('error')" />

            <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên danh mục</label>
                            <input class="form-control" name="catename" value="{{ old('catename', $category->catename) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thứ tự</label>
                            <input class="form-control" type="number" min="0" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1" @selected(old('status', $category->status)==1)>Hiện</option>
                                <option value="0" @selected(old('status', $category->status)==0)>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>
                    <textarea class="form-control" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
