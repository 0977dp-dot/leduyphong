@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')
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
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset($item->image ? 'images/products/' . $item->image : 'images/default.png') }}"
                            alt="{{ $item->productname }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>

                    <td>{{ $item->productname }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                    <td>{{ number_format($item->pricediscount, 0, ',', '.') }} đ</td>
                    <td>{{ $item->catename }}</td>
                    <td>{{ $item->brandname ?? 'N/A' }}</td>
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