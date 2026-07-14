@extends('admin.layouts.admin')
@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<h2>Sửa thương hiệu</h2>@include('admin._partials.errors')
<form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">@csrf @method('PUT')
    <div class="mb-3"><label>Tên</label><input class="form-control" name="brandname" value="{{ old('brandname', $brand->brandname) }}" required></div>
    <div class="mb-3"><label>Slug</label><input class="form-control" name="slug" value="{{ old('slug', $brand->slug) }}" required></div>
    <div class="mb-3"><label>Mô tả</label><textarea class="form-control" name="description">{{ old('description', $brand->description) }}</textarea></div>
    <div class="mb-3"><label>Thứ tự</label><input class="form-control" type="number" min="0" name="sort_order" value="{{ old('sort_order', $brand->sort_order) }}"></div>
    <div class="mb-3"><label>Trạng thái</label><select class="form-select" name="status">
            <option value="1" @selected(old('status', $brand->status)==1)>Hiện</option>
            <option value="0" @selected(old('status', $brand->status)==0)>Ẩn</option>
        </select></div><button class="btn btn-primary">Lưu</button> <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
