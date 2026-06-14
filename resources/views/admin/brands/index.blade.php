@extends('admin.layouts.admin')

@section('title', 'Thương hiệu')

@section('content')
    <h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên thương hiệu</th>
                <th>Slug</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset($item->image ? 'images/brands/' . $item->image : 'images/default.png') }}"
                            alt="{{ $item->brandname }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>

                    <td>{{ $item->brandname }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection