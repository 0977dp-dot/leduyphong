{{-- thừa kế layout/view admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Tiêu đề --}}
@section('title', 'Xin chào')

{{-- Nội dung --}}
@section('content')

<div class="container mt-5">
    <h1>My Dashboard</h1>

    <button class="btn btn-primary">
        Hello Bootstrap
    </button>

    <button class="btn btn-success">
        Success
    </button>

    <button class="btn btn-danger">
        Danger
    </button>
</div>

@endsection