@props(['type' => 'success'])

@if(session('message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
</div>
@endif