<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--light-bg); color: #2c3e50; }
        .navbar { background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 1rem 0; }
        .navbar-brand { font-size: 1.5rem; font-weight: 700; color: #fff !important; display: flex; align-items: center; gap: 0.5rem; }
        .navbar-brand i { color: var(--accent-color); font-size: 1.8rem; }
        .nav-link { color: rgba(255,255,255,0.8) !important; font-weight: 500; transition: all 0.3s ease; padding: 0.5rem 1rem !important; border-radius: 4px; margin: 0 0.25rem; }
        .nav-link:hover { color: var(--accent-color) !important; background-color: rgba(255,255,255,0.1); }
        .navbar-text { color: rgba(255,255,255,0.9) !important; font-size: 0.95rem; }
        .navbar-text strong { color: var(--accent-color); }
        .alert { border: none; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        .alert-success { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s; margin-bottom: 1.5rem; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.12); }
        .card-header { border: none; border-bottom: 2px solid var(--border-color); padding: 1.25rem; font-weight: 600; }
        .btn { border: none; border-radius: 6px; font-weight: 600; padding: 0.6rem 1.2rem; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .btn-primary { background-color: var(--primary-color); color: white; }
        .btn-primary:hover { background-color: #1a252f; color: white; }
        .table { background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .table thead { background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%); color: white; font-weight: 600; }
        .table tbody tr { border-color: var(--border-color); transition: background-color 0.3s; }
        .table tbody tr:hover { background-color: var(--light-bg); }
        .badge { padding: 0.5rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        main { min-height: calc(100vh - 200px); }
        h2, h3, h4 { color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem; }
        h2 { font-size: 2rem; border-bottom: 3px solid var(--accent-color); display: inline-block; padding-bottom: 0.5rem; }
        .form-control, .form-select { border: 2px solid var(--border-color); border-radius: 6px; padding: 0.75rem 1rem; transition: border-color 0.3s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.15); }
        .form-label { font-weight: 600; color: var(--primary-color); margin-bottom: 0.5rem; }
        footer { background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%); color: white; padding: 2rem 0; margin-top: auto; text-align: center; border-top: 2px solid var(--accent-color); }
        footer p { margin: 0; font-size: 0.95rem; }
        @media (max-width: 768px) { h2 { font-size: 1.5rem; } .btn { padding: 0.5rem 1rem; font-size: 0.9rem; } }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-shopping-bag"></i>
                <span>Dhaskay</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-box"></i> Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stores.index') }}">
                                <i class="fas fa-store"></i> Toko
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stocks.index') }}">
                                <i class="fas fa-cubes"></i> Stok
                            </a>
                        </li>
                        <li class="nav-item">
                            <span class="navbar-text me-3">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <div class="container mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p><i class="fas fa-copyright"></i> 2025 <strong>Dhaskay E-Commerce</strong>. Semua Hak Dilindungi.</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">Dibuat untuk Practicum | Laravel 12.41.1</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
