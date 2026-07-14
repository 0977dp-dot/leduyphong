@extends('admin.layouts.admin')
@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<h2>Sửa người dùng</h2>@include('admin._partials.errors')
<form action="{{ route('admin.users.update', $user->userid) }}" method="POST">@csrf @method('PUT') @include('admin.users.form', ['user' => $user])<button class="btn btn-primary">Lưu</button> <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a></form>
@endsection
