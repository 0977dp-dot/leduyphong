@extends('admin.layouts.admin')
@section('title', 'Bài viết')
@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Slug</th>
            <th>Người viết</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $item)<tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->slug }}</td>
            <td>{{ $item->fullname ?? 'N/A' }}</td>
            <td>{{ $item->status == 1 ? 'Xuất bản' : 'Nháp' }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $item->id) }}"
                    class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <form action="{{ route('admin.posts.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">
                        Xóa
                    </button>
                </form>
                </td>
        </tr>@empty<tr>
            <td colspan="6" class="text-center">Không có dữ liệu</td>
        </tr>@endforelse
    </tbody>
</table>{{ $list->links() }}
@endsection