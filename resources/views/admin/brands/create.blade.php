@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
    <h2 class="mb-4">THÊM THƯƠNG HIỆU MỚI</h2>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control">
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hiện</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection