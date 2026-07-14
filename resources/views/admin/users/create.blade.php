@extends('admin.layouts.admin')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Thêm người dùng</h3>
                    <p class="text-muted mb-0">Vui lòng điền đầy đủ thông tin tài khoản.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Quay lại</a>
            </div>

            @include('admin._partials.errors')
            <x-admin.alert type="danger" :message="session('error')" />

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                @include('admin.users.form', ['user' => null])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
