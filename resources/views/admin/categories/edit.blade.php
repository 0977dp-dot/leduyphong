@extends('admin.layouts.admin')
@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<h2>Sửa danh mục</h2>@include('admin._partials.errors')
<form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">@csrf @method('PUT')
    <div class="mb-3"><label>Tên</label><input class="form-control" name="catename" value="{{ old('catename', $category->catename) }}" required></div>
    <div class="mb-3"><label>Slug</label><input class="form-control" name="slug" value="{{ old('slug', $category->slug) }}" required></div>
    <div class="mb-3"><label>Mô tả</label><textarea class="form-control" name="description">{{ old('description', $category->description) }}</textarea></div>
    <div class="mb-3"><label>Thứ tự</label><input class="form-control" type="number" min="0" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"></div>
    <div class="mb-3"><label>Trạng thái</label><select class="form-select" name="status">
            <option value="1" @selected(old('status', $category->status)==1)>Hiện</option>
            <option value="0" @selected(old('status', $category->status)==0)>Ẩn</option>
        </select></div><button class="btn btn-primary">Lưu</button> <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
