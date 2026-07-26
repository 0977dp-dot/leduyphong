<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="d-flex min-vh-100">
        <aside class="bg-dark text-white vh-100 p-3" style="width: 250px;">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-white fs-5">
                    Admin Dashboard
                </a>
            </div>
            @include('admin._partials.sidebar')
        </aside>

        <div class="flex-fill">
            @include('admin._partials.header')

            <main class="container-fluid py-4">
                @yield('content')
            </main>

            @include('admin._partials.footer')
        </div>
    </div>
</body>
</html>
