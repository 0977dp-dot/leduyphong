<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }

        /* SIDEBAR FIXED */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
        }

        /* RIGHT AREA */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #fff;
            border-bottom: 1px solid #ddd;
        }

        main {
            flex: 1;
            background: #f8f9fa;
            padding: 20px;
        }

        footer {
            background: #212529;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar text-white p-3">
        @include('admin._partials.sidebar')
    </div>

    {{-- RIGHT CONTENT --}}
    <div class="main-wrapper">

        {{-- HEADER --}}
        <header>
            @include('admin._partials.header')
        </header>

        {{-- MAIN --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer>
            @include('admin._partials.footer')
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>