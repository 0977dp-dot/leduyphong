@extends('admin.layouts.admin')

@section('title','Chi tiết đơn hàng')

@section('content')

<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Chi tiết đơn hàng #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Quay lại danh sách</a>
    </div>

    <hr>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Thông tin khách hàng</h5>
            <p><strong>Họ tên:</strong> {{ $order->customer->fullname ?? 'N/A' }}</p>
            <p><strong>SĐT:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'N/A' }}</p>
        </div>
        <div class="col-md-6">
            <h5>Cập nhật trạng thái</h5>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select w-auto">
                    <option value="Pending" @selected($order->status == 'Pending')>Pending (Chờ xử lý)</option>
                    <option value="Processing" @selected($order->status == 'Processing')>Processing (Đang xử lý)</option>
                    <option value="Completed" @selected($order->status == 'Completed')>Completed (Đã hoàn thành)</option>
                    <option value="Cancelled" @selected($order->status == 'Cancelled')>Cancelled (Đã hủy)</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            </form>
        </div>
    </div>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->productname ?? 'Sản phẩm không tồn tại' }}</td>
                <td>{{ number_format($item->price) }} đ</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity) }} đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 class="text-end">
        Tổng cộng:
        {{ number_format($order->total) }} VNĐ
    </h4>

</div>

@endsection