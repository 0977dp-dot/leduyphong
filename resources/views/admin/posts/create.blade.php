@extends('admin.layouts.admin')
@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<h2>Thêm bài viết</h2>@include('admin._partials.errors')
<form action="{{ route('admin.posts.store') }}" method="POST">@csrf @include('admin.posts.form', ['post' => null])<button class="btn btn-primary">Lưu</button> <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a></form>
@endsection
