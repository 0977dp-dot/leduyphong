{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends('admin.layouts.admin')

{{-- Gắn nội dung cho vùng section 'title'  --}}
{{-- tương ứng với @yield('title') trong layout --}}
@section('title', 'Xin chào')
@section('content')
<h1>My Dashboard </h1>
@endsection