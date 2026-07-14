@extends('admin.layouts.admin')

@section('title', 'Loại sản phẩm')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>

    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                @if ($item->image)
                <img src="{{ asset('storage/categories/' . $item->image) }}" width="80" class="img-thumbnail">
                @else
                <span class="text-muted">Không có ảnh</span>
                @endif
            </td>

            <td>{{ $item->cateid }}</td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>

            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hiện</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>

            {{-- ACTION --}}
            <td>

                <a href="{{ route('admin.categories.edit', $item->cateid) }}"
                    class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <form action="{{ route('admin.categories.destroy', $item->cateid) }}"
                    method="POST"
                    class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                        Xóa
                    </button>

                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                Không có dữ liệu
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- PAGINATION --}}
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection