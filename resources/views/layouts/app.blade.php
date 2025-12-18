<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Inventory ATK')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #5a4fcf;
            --sidebar-hover: rgba(255,255,255,0.1);
            --sidebar-active: rgba(255,255,255,0.2);
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sidebar */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #6f5de7 0%, #5a4fcf 100%);
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
        .sidebar-header {
            padding: 15px 20px;
            background: rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .sidebar-brand:hover {
            color: #fff;
        }
        .user-panel {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-panel img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-panel .user-info {
            color: #fff;
        }
        .user-panel .user-info .name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        .user-panel .user-info .role {
            font-size: 0.8rem;
            opacity: 0.8;
        }
        .sidebar-menu {
            padding: 10px 0;
        }
        .menu-header {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px;
            font-weight: 600;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: #fff;
        }
        .sidebar .nav-link.active {
            background-color: var(--sidebar-active);
            color: #fff;
            border-left-color: #fff;
        }
        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        .top-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-content {
            padding: 30px;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* Stats Cards */
        .stats-card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-3px);
        }
        .stats-card .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }
        .stats-card .stats-info .label {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }
        .stats-card .stats-info .value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .stats-card.primary { background: linear-gradient(135deg, #f5f7ff 0%, #e8ecff 100%); }
        .stats-card.primary .icon-box { background: #e0e5ff; color: #5a4fcf; }
        .stats-card.success { background: linear-gradient(135deg, #f0fff4 0%, #dcffe4 100%); }
        .stats-card.success .icon-box { background: #d4f5e9; color: #28a745; }
        .stats-card.warning { background: linear-gradient(135deg, #fffbf0 0%, #fff3dc 100%); }
        .stats-card.warning .icon-box { background: #fff0c2; color: #ffc107; }
        .stats-card.danger { background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%); }
        .stats-card.danger .icon-box { background: #ffd6d6; color: #dc3545; }
        .stats-card.info { background: linear-gradient(135deg, #f0f9ff 0%, #e0f2ff 100%); }
        .stats-card.info .icon-box { background: #cce7ff; color: #17a2b8; }
        .stats-card.orange { background: linear-gradient(135deg, #fff8f0 0%, #ffedd8 100%); }
        .stats-card.orange .icon-box { background: #ffe4c4; color: #fd7e14; }
        /* Cards */
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 10px;
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            font-weight: 600;
        }
        /* Table */
        .table th {
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #dee2e6;
        }
        .badge-stok {
            font-size: 0.85rem;
            padding: 5px 12px;
            border-radius: 20px;
        }
        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            color: #888;
            font-size: 0.85rem;
        }
        footer a {
            color: #5a4fcf;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="bi bi-box-seam me-2"></i>Inventory ATK
            </a>
            <i class="bi bi-list text-white" style="cursor:pointer;"></i>
        </div>
        
        <div class="user-panel">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="User">
            <div class="user-info">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">{{ auth()->user()->role_label }}</div>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-house-door"></i>Dashboard
            </a>

            <div class="menu-header">Master</div>
            {{-- Barang: Admin (CRUD), Staf Gudang (Tambah/Edit), Kasir (Lihat) --}}
            <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ route('barang.index') }}">
                <i class="bi bi-archive"></i>Barang
                @if(auth()->user()->isKasir())
                    <span class="badge bg-secondary ms-auto">View</span>
                @endif
            </a>

            <div class="menu-header">Transaksi</div>
            {{-- Barang Masuk: Admin & Staf Gudang --}}
            @if(auth()->user()->isAdmin() || auth()->user()->isStafGudang())
            <a class="nav-link {{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}" href="{{ route('stok-masuk.index') }}">
                <i class="bi bi-box-arrow-in-down"></i>Barang Masuk
            </a>
            @endif
            
            {{-- Barang Keluar: Admin & Kasir --}}
            @if(auth()->user()->isAdmin() || auth()->user()->isKasir())
            <a class="nav-link {{ request()->routeIs('stok-keluar.*') ? 'active' : '' }}" href="{{ route('stok-keluar.index') }}">
                <i class="bi bi-box-arrow-up"></i>Barang Keluar
            </a>
            @endif

            <div class="menu-header">Laporan</div>
            {{-- Laporan Stok: Semua role bisa akses --}}
            <a class="nav-link {{ request()->routeIs('laporan.stok') ? 'active' : '' }}" href="{{ route('laporan.stok') }}">
                <i class="bi bi-file-earmark-text"></i>Laporan Stok
            </a>
            
            {{-- Laporan Barang Masuk: Admin & Staf Gudang --}}
            @if(auth()->user()->isAdmin() || auth()->user()->isStafGudang())
            <a class="nav-link {{ request()->routeIs('laporan.masuk') ? 'active' : '' }}" href="{{ route('laporan.masuk') }}">
                <i class="bi bi-file-earmark-arrow-down"></i>Laporan Barang Masuk
            </a>
            @endif
            
            {{-- Laporan Barang Keluar: Admin & Kasir --}}
            @if(auth()->user()->isAdmin() || auth()->user()->isKasir())
            <a class="nav-link {{ request()->routeIs('laporan.keluar') ? 'active' : '' }}" href="{{ route('laporan.keluar') }}">
                <i class="bi bi-file-earmark-arrow-up"></i>Laporan Barang Keluar
            </a>
            @endif

            {{-- Pengaturan: Admin Only --}}
            @if(auth()->user()->isAdmin())
            <div class="menu-header">Pengaturan</div>
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="bi bi-people"></i>Manajemen User
            </a>
            @endif

            <div class="menu-header">Akun</div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-left"></i>Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-content">
            @yield('content')
        </div>

        <footer>
            Copyright &copy; {{ date('Y') }} - <a href="#">Inventory ATK</a>. All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')