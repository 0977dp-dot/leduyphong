@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')
@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif
<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
    Thêm sản phẩm
</a>
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Giá giảm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                @if ($item->image)
                <img src="{{ asset('storage/products/' . $item->image) }}" width="80" class="img-thumbnail">
                @endif
            </td>

            <td>{{ $item->productname }}</td>

            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>

            <td>{{ number_format($item->pricediscount, 0, ',', '.') }} đ</td>

            <td>{{ $item->catename ?? 'N/A' }}</td>

            <td>{{ $item->brandname ?? 'N/A' }}</td>

            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>

            <td>
                <a href="{{ route('admin.products.edit', $item->id) }}"
                    class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <form action="{{ route('admin.products.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                        Xóa
                    </button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">Không có dữ liệu</td>
        </tr>
        @endforelse
    </tbody>

</table>
</table>

<div class="d-flex justify-content-between align-items-center mt-4">

    <div>
        Hiển thị
        {{ $list->firstItem() ?? 0 }}
        -
        {{ $list->lastItem() ?? 0 }}
        trên tổng
        {{ $list->total() }}
        sản phẩm
    </div>

    <div>
        {{ $list->links() }}
    </div>

</div>

@endsection