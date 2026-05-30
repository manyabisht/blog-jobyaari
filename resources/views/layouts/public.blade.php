<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'JobYaari Blog'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="site-shell">
    <nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('blogs.index') }}">
                <span class="brand-mark">JY</span>
                <span>JobYaari Blog</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav" aria-controls="publicNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNav">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blogs</a>
                    @auth
                        <a class="btn btn-sm btn-dark d-inline-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                            <i data-lucide="layout-dashboard" class="icon"></i>
                            Dashboard
                        </a>
                    @else
                        <a class="btn btn-sm btn-outline-dark d-inline-flex align-items-center gap-2" href="{{ route('login') }}">
                            <i data-lucide="lock-keyhole" class="icon"></i>
                            Admin Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-top bg-white py-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 text-muted small">
            <span>&copy; {{ now()->year }} JobYaari Blog Management System</span>
            <span>Built with Laravel, Bootstrap, jQuery, and MySQL.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        window.lucide?.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
