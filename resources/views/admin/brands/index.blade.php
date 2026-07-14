@extends('admin.layouts.admin')

@section('title', 'Thương hiệu')

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

<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

<a href="{{ route('admin.brands.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Mã</th>
            <th>Hình ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Thứ tự</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>

    <tbody>
        @foreach($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->id }}</td>

            <td>
                @if($item->image)
                    <img src="{{ asset('storage/brands/' . $item->image) }}"
                         width="80"
                         height="80"
                         class="img-thumbnail"
                         style="object-fit: cover;">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </td>

            <td>{{ $item->brandname }}</td>

            <td>{{ $item->slug }}</td>

            <td>{{ $item->sort_order ?? 0 }}</td>

            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>

            <td>
                <a href="{{ route('admin.brands.edit', $item->id) }}"
                   class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <form action="{{ route('admin.brands.destroy', $item->id) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Xóa thương hiệu này?')">
                        Xóa
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection