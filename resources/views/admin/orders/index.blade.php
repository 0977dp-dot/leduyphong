@extends('admin.layouts.admin')
@section('title','Quản lý đơn hàng')

@section('content')
<div class="container">
    <h3 class="mb-4">Danh sách đơn hàng</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer->fullname ?? 'Khách lẻ' }} ({{ $order->customer->phone ?? 'N/A' }})</td>
                <td>{{ number_format($order->total) }} đ</td>
                <td>
                    <span class="badge bg-{{ $order->status == 'Completed' ? 'success' : ($order->status == 'Cancelled' ? 'danger' : 'warning') }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '' }}</td>
                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection
