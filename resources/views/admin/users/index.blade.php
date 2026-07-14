@extends('admin.layouts.admin')
@section('title', 'Người dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>
<table class="table table-bordered table-hover"><thead class="table-dark"><tr><th>STT</th><th>Họ tên</th><th>Tên đăng nhập</th><th>Email</th><th>Điện thoại</th><th>Vai trò</th><th>Trạng thái</th><th>Chức năng</th></tr></thead><tbody>
@forelse($list as $item)<tr><td>{{ $loop->iteration }}</td><td>{{ $item->fullname }}</td><td>{{ $item->username }}</td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td><td>{{ $item->role == 1 ? 'Quản trị viên' : 'Người dùng' }}</td><td>{{ $item->status == 1 ? 'Hoạt động' : 'Khóa' }}</td><td><a href="{{ route('admin.users.edit', $item->userid) }}" class="btn btn-warning btn-sm">Sửa</a></td></tr>@empty<tr><td colspan="8" class="text-center">Không có dữ liệu</td></tr>@endforelse
</tbody></table>{{ $list->links() }}
@endsection
