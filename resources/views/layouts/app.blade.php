<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockku - Premium POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --accent: #ec4899;
            --bg-color: #0f172a;
            --surface: rgba(30, 41, 59, 0.7);
            --surface-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--surface-border);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-main) !important;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            color: var(--text-main) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .glass-card {
            background: var(--surface);
            backdrop-filter: blur(16px);
            border: 1px solid var(--surface-border);
            border-radius: 1rem;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            padding: 2rem;
        }

        .table {
            color: var(--text-main);
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }
        .table>:not(caption)>*>* {
            background-color: transparent;
            border-bottom-color: var(--surface-border);
            color: var(--text-main);
            padding: 1rem;
            vertical-align: middle;
        }
        .table thead th {
            border-bottom: 2px solid var(--primary);
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        .table tbody tr {
            background: rgba(255, 255, 255, 0.02);
            transition: transform 0.2s, background 0.2s;
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-2px);
        }

        .form-control, .form-select {
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--surface-border);
            color: var(--text-main);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background-color: rgba(15, 23, 42, 0.8);
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
            color: var(--text-main);
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            border: none;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }
        .btn-accent {
            background: linear-gradient(135deg, var(--accent), #be185d);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.3);
        }
        .btn-accent:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(236, 72, 153, 0.4);
        }

        .main-content {
            flex: 1;
            padding: 2rem 0;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">Stockku</a>
        <button class="navbar-toggler btn-light" type="button" data-bs-toggle="collapse" data-bs-toggle="target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Kelola Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.transactions') }}">Laporan Transaksi</a>
                        </li>
                    @elseif(Auth::user()->role === 'kasir')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kasir.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kasir.index') }}">Mulai Kasir</a>
                        </li>
                    @elseif(Auth::user()->role === 'gudang')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gudang.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gudang.products') }}">Update Stok</a>
                        </li>
                    @elseif(Auth::user()->role === 'owner')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owner.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owner.products') }}">Laporan Stok</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owner.transactions') }}">Laporan Penjualan</a>
                        </li>
                    @endif
                    
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm" style="border-radius:20px; border-color: var(--surface-border);">
                                Logout, {{ explode(' ', Auth::user()->name)[0] }}
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-primary btn-sm" style="border-radius:20px;" href="{{ route('register') }}">Register Karyawan</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show glass-card mb-4" role="alert" style="background: rgba(16, 185, 129, 0.2); border-color: rgba(16, 185, 129, 0.3);">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show glass-card mb-4" role="alert" style="background: rgba(239, 68, 68, 0.2); border-color: rgba(239, 68, 68, 0.3);">
            {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger glass-card mb-4" style="background: rgba(239, 68, 68, 0.2); border-color: rgba(239, 68, 68, 0.3);">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>