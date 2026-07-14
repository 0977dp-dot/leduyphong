@extends('admin.layouts.admin')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Sửa bài viết</h3>
                    <p class="text-muted mb-0">Cập nhật thông tin bài viết hiện tại.</p>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
            </div>

            @include('admin._partials.errors')
            <x-admin.alert type="danger" :message="session('error')" />

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.posts.form', ['post' => $post])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary">Lưu</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
