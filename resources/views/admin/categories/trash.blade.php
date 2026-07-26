@extends('admin.layouts.admin')

@section('title', 'Trash-Loại Sản phẩm')

@section('content')
    <h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM - ĐANG CHỜ XÓA</h2>

    <x-admin.alert />

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i>
                Quay lại danh sách
            </a>
            <span class="badge bg-warning text-dark ms-2">Số lượng trong thùng rác: {{ $trashCount }}</span>
        </div>

        <div class="d-flex gap-2">
            <form action="{{ route('admin.categories.restoreAll') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Khôi phục tất cả</button>
            </form>

            <form action="{{ route('admin.categories.forceDeleteAll') }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa vĩnh viễn tất cả?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn tất cả</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Mã loại</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->cateid }}</td>
                    <td>{{ $item->catename }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.restore', $item->cateid) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                        </form>

                        <form action="{{ route('admin.categories.forceDelete', $item->cateid) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa vĩnh viễn?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có mục nào trong thùng rác.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
@endsection