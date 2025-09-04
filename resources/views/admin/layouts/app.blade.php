<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoGlary Admin') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- GoGlary CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/goglary.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <!-- Custom Admin CSS -->
    <style>
        /* Admin specific styles */
        .admin-wrapper {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(135deg, #212934 0%, #1d242d 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .admin-sidebar .sidebar-header {
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar .sidebar-header h3 {
            margin: 0;
            color: #59ab6e;
            font-weight: 500;
        }

        .admin-sidebar .components {
            padding: 20px 0;
        }

        .admin-sidebar .components li {
            list-style: none;
            padding: 0;
        }

        .admin-sidebar .components li a {
            display: block;
            padding: 15px 25px;
            color: #cfd6e1;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .components li a:hover,
        .admin-sidebar .components li.active a {
            background: rgba(89, 171, 110, 0.2);
            color: #59ab6e;
            border-left-color: #59ab6e;
            text-decoration: none;
        }

        .admin-sidebar .components li.active a {
            background: rgba(89, 171, 110, 0.3);
            font-weight: 500;
        }

        .admin-content {
            margin-left: 280px;
            transition: all 0.3s;
        }

        .admin-navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
        }

        .admin-navbar .navbar-brand {
            color: #59ab6e !important;
            font-weight: 500;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .card-body {
            padding: 25px;
        }

        .stats-card .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stats-card.primary .stats-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card.success .stats-icon {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            color: white;
        }

        .stats-card.warning .stats-icon {
            background: linear-gradient(135deg, #ede861 0%, #f4c430 100%);
            color: white;
        }

        .stats-card.info .stats-icon {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .table-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .table-card .card-header {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            color: white;
            padding: 20px 25px;
            border: none;
        }

        .table-card .card-header h6 {
            margin: 0;
            font-weight: 500;
        }

        .table-card .table {
            margin: 0;
        }

        .table-card .table thead th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #212934;
            padding: 15px;
        }

        .table-card .table tbody td {
            padding: 15px;
            border: none;
            vertical-align: middle;
        }

        .btn-goglary {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-goglary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(89, 171, 110, 0.4);
            color: white;
        }

        .badge-goglary {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
            }

            .admin-content.active {
                margin-left: 280px;
            }
        }

        /* Custom scrollbar */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #59ab6e;
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: #56ae6c;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="admin-sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-tachometer-alt me-2"></i>GoGlary Admin</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                </li>

                @can('view users')
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users me-2"></i>Users
                    </a>
                </li>
                @endcan

                @can('view products')
                <li class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">
                        <i class="fas fa-box me-2"></i>Products
                    </a>
                </li>
                @endcan

                @can('view categories')
                <li class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}">
                        <i class="fas fa-tags me-2"></i>Categories
                    </a>
                </li>
                @endcan

                @can('view brands')
                <li class="{{ request()->routeIs('brands.*') ? 'active' : '' }}">
                    <a href="{{ route('brands.index') }}">
                        <i class="fas fa-copyright me-2"></i>Brands
                    </a>
                </li>
                @endcan

                @can('view orders')
                <li class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-cart me-2"></i>Orders
                    </a>
                </li>
                @endcan

                <li class="mt-4">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-store me-2"></i>Back to Store
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="admin-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light admin-navbar">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary me-3">
                        <i class="fas fa-bars"></i>
                    </button>

                    <span class="navbar-brand mb-0 h1">GoGlary Admin Panel</span>

                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid mt-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Sidebar toggle
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarCollapse = document.getElementById('sidebarCollapse');

            if (!sidebar.contains(event.target) && !sidebarCollapse.contains(event.target)) {
                sidebar.classList.remove('active');
                document.getElementById('content').classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
