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
            </ul>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <div class="footer-icons">
                    <a href="{{ setting('store_url') }}" class="footer-icon store"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Back to Store">
                        <i class="fas fa-store"></i>
                    </a>

                    @can('view settings')
                    <a href="{{ route('settings.index') }}" class="footer-icon"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Settings">
                        <i class="fas fa-cog"></i>
                    </a>
                    @endcan
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="admin-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light admin-navbar">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary me-3">
                        <i class="fas fa-bars"></i>
                    </button>

                    <span class="navbar-brand mb-0 h1 d-none d-md-block">GoGlary Admin Panel</span>

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

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ __('Please fix the following errors:') }}
                        <ul class="mb-0 ml-5 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Sidebar toggle with localStorage persistence
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const sidebarCollapse = document.getElementById('sidebarCollapse');

            // Function to check if we're on mobile
            function isMobile() {
                return window.innerWidth <= 768;
            }

            // Function to update toggle button icon
            function updateToggleIcon() {
                const button = document.getElementById('sidebarCollapse');
                if (button) {
                    const mobile = isMobile();
                    const isActive = sidebar.classList.contains('active');

                    if (mobile) {
                        // Mobile: bars = show sidebar, times = hide sidebar
                        button.innerHTML = isActive ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
                    } else {
                        // Desktop: bars = expand, chevron-left = collapse
                        button.innerHTML = isActive ? '<i class="fas fa-chevron-right"></i>' : '<i class="fas fa-bars"></i>';
                    }
                }
            }

            // Update icon on toggle
            function toggleSidebar() {
                const currentlyActive = sidebar.classList.contains('active');
                const mobile = isMobile();

                if (mobile) {
                    // Mobile behavior: toggle visibility of sidebar above content
                    if (currentlyActive) {
                        // Sidebar is currently hidden, show it
                        sidebar.classList.remove('active');
                        content.classList.remove('active');
                        localStorage.setItem('sidebar_active', 'false');
                    } else {
                        // Sidebar is currently visible, hide it
                        sidebar.classList.add('active');
                        content.classList.add('active');
                        localStorage.setItem('sidebar_active', 'true');
                    }
                } else {
                    // Desktop behavior: toggle collapse/expand
                    if (currentlyActive) {
                        sidebar.classList.remove('active');
                        content.classList.remove('active');
                        localStorage.setItem('sidebar_active', 'false');
                    } else {
                        sidebar.classList.add('active');
                        content.classList.add('active');
                        localStorage.setItem('sidebar_active', 'true');
                    }
                }

                // Update button icon after toggle
                setTimeout(updateToggleIcon, 50);
            }

            // Initialize sidebar state based on localStorage and screen size
            function initializeSidebar() {
                const isActive = localStorage.getItem('sidebar_active') === 'true';
                const mobile = isMobile();

                if (mobile) {
                    // On mobile: sidebar is visible by default (no 'active' class)
                    // When 'active' is true, it means sidebar should be hidden
                    if (isActive) {
                        sidebar.classList.add('active');
                        content.classList.add('active');
                    } else {
                        sidebar.classList.remove('active');
                        content.classList.remove('active');
                    }
                } else {
                    // Desktop behavior: 'active' means sidebar is collapsed (hidden)
                    if (isActive) {
                        sidebar.classList.add('active');
                        content.classList.add('active');
                    } else {
                        sidebar.classList.remove('active');
                        content.classList.remove('active');
                    }
                }
            }

            // Initialize on page load
            initializeSidebar();
            updateToggleIcon();

            // Add click event listener for toggle button
            if (sidebarCollapse) {
                sidebarCollapse.addEventListener('click', toggleSidebar);
            }

            // Handle window resize to update behavior
            window.addEventListener('resize', function() {
                // Re-initialize sidebar state when switching between mobile/desktop
                setTimeout(function() {
                    initializeSidebar();
                    updateToggleIcon();
                }, 100);
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
