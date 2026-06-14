@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')

<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Slug</th>
            <th>Người viết</th>
            <th>Trạng thái</th>
        </tr>
    </thead>

    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                <img src="{{ asset($item->image ? 'images/posts/'.$item->image : 'images/default.png') }}"
                     style="width:50px;height:50px;object-fit:cover;">
            </td>

            <td>{{ $item->title }}</td>
            <td>{{ $item->slug }}</td>

            {{-- user_id -> cần join users để lấy fullname --}}
            <td>{{ $item->fullname ?? 'N/A' }}</td>

            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Xuất bản</span>
                @else
                    <span class="badge bg-secondary">Nháp</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Không có dữ liệu</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection