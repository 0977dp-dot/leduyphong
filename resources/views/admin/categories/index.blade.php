@extends('admin.layouts.admin')

@section('title', 'Loại Sản phẩm')

@section('content')
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
                <img
                    src="{{ asset($item->image ? 'images/categories/' . $item->image : 'images/default.png') }}"
                    alt="{{ $item->catename }}"
                    style="width:50px;height:50px;object-fit:cover;">
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
                Chưa có dữ liệu
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection