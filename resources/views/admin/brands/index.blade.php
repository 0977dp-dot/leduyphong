@extends('admin.layouts.admin')

@section('title', 'Thương hiệu')

@section('content')
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
                <img src="{{ asset($item->image ? 'images/brands/'.$item->image : 'images/default.png') }}"
                     style="width:50px;height:50px;object-fit:cover;">
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

            {{-- ACTION --}}
            <td>

                {{-- SỬA --}}
                <a href="{{ route('admin.brands.edit', $item->id) }}"
                   class="btn btn-warning btn-sm">
                    Sửa
                </a>

                {{-- XÓA --}}
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

{{-- PAGINATION --}}
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection