@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fw-light text-dark mb-3">
                        Welcome back, <span class="text-success">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="lead text-muted mb-4">
                        Here's what's happening with your store today. Stay updated with the latest insights and manage your business efficiently.
                    </p>
                    <div class="hero-stats d-flex gap-4">
                        <div class="stat-item">
                            <h3 class="text-success mb-0">{{ $totalUsers ?? 0 }}</h3>
                            <small class="text-muted">Active Users</small>
                        </div>
                        <div class="stat-item">
                            <h3 class="text-primary mb-0">{{ $totalProducts ?? 0 }}</h3>
                            <small class="text-muted">Total Products</small>
                        </div>
                        <div class="stat-item">
                            <h3 class="text-warning mb-0">{{ $totalOrders ?? 0 }}</h3>
                            <small class="text-muted">Orders Today</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-end">
                <div class="hero-date">
                    <div class="date-display">
                        <h4 class="mb-0">{{ now()->format('F j, Y') }}</h4>
                        <small class="text-muted">{{ now()->format('l') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards Row -->
<div class="row mb-5">
    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="card stats-card primary h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stats-content">
                        <div class="stats-icon-wrapper mb-3">
                            <div class="stats-icon bg-primary">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Total Users</h6>
                        <h2 class="mb-1 fw-light">{{ $totalUsers ?? 0 }}</h2>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span class="text-success fw-bold">+12%</span>
                            <small class="text-muted ms-1">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="card stats-card success h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stats-content">
                        <div class="stats-icon-wrapper mb-3">
                            <div class="stats-icon bg-success">
                                <i class="fas fa-box fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Total Products</h6>
                        <h2 class="mb-1 fw-light">{{ $totalProducts ?? 0 }}</h2>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span class="text-success fw-bold">+8%</span>
                            <small class="text-muted ms-1">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="card stats-card warning h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stats-content">
                        <div class="stats-icon-wrapper mb-3">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Total Orders</h6>
                        <h2 class="mb-1 fw-light">{{ $totalOrders ?? 0 }}</h2>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span class="text-success fw-bold">+15%</span>
                            <small class="text-muted ms-1">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 mb-4">
        <div class="card stats-card info h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="stats-content">
                        <div class="stats-icon-wrapper mb-3">
                            <div class="stats-icon bg-info">
                                <i class="fas fa-dollar-sign fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase fw-bold text-muted mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Revenue</h6>
                        <h2 class="mb-1 fw-light">${{ number_format($totalRevenue ?? 0, 2) }}</h2>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up text-success me-1"></i>
                            <span class="text-success fw-bold">+22%</span>
                            <small class="text-muted ms-1">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row mb-5">
    <!-- Recent Orders Section -->
    <div class="col-lg-8 mb-4">
        <div class="card table-card h-100 border-0 shadow-sm">
            <div class="card-header bg-gradient-primary text-white border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-clock me-2"></i>Recent Orders
                        </h6>
                        <small class="opacity-75">Latest customer orders</small>
                    </div>
                    <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-eye me-1"></i>View All
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Order ID</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Customer</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Status</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Total</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Date</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size: 13px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders->take(5) as $order)
                                <tr class="border-bottom border-light">
                                    <td>
                                        <span class="fw-bold text-primary">#{{ $order->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white me-2" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                {{ strtoupper(substr($order->user->name ?? 'N', 0, 1)) }}
                                            </div>
                                            <span class="fw-medium">{{ $order->user->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'completed' => 'bg-success',
                                                'pending' => 'bg-warning',
                                                'processing' => 'bg-info',
                                                'cancelled' => 'bg-danger'
                                            ];
                                            $statusClass = $statusClasses[$order->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }} badge-sm">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">${{ number_format($order->total, 2) }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn action-btn view">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                            <h5 class="text-muted mb-2">No orders yet</h5>
                            <p class="text-muted mb-4">Orders will appear here once customers start shopping.</p>
                            <a href="{{ route('products.create') }}" class="btn btn-goglary">
                                <i class="fas fa-plus me-2"></i>Add Your First Product
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="col-lg-4 mb-4">
        <div class="card table-card h-100 border-0 shadow-sm">
            <div class="card-header bg-gradient-success text-white border-0">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="action-grid">
                    @can('create products')
                    <a href="{{ route('products.create') }}" class="action-card">
                        <div class="action-icon bg-primary">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="action-content">
                            <h6 class="mb-1">Add Product</h6>
                            <small class="text-muted">Create new product</small>
                        </div>
                    </a>
                    @endcan

                    @can('create users')
                    <a href="{{ route('users.create') }}" class="action-card">
                        <div class="action-icon bg-success">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="action-content">
                            <h6 class="mb-1">Add User</h6>
                            <small class="text-muted">Create new user</small>
                        </div>
                    </a>
                    @endcan

                    @can('view orders')
                    <a href="{{ route('orders.index') }}" class="action-card">
                        <div class="action-icon bg-warning">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="action-content">
                            <h6 class="mb-1">View Orders</h6>
                            <small class="text-muted">Manage all orders</small>
                        </div>
                    </a>
                    @endcan

                    @can('view categories')
                    <a href="{{ route('categories.index') }}" class="action-card">
                        <div class="action-icon bg-info">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="action-content">
                            <h6 class="mb-1">Categories</h6>
                            <small class="text-muted">Manage categories</small>
                        </div>
                    </a>
                    @endcan

                    <div class="action-divider"></div>

                    <a href="{{ route('dashboard') }}" class="action-card">
                        <div class="action-icon bg-secondary">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="action-content">
                            <h6 class="mb-1">Go to Store</h6>
                            <small class="text-muted">View storefront</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Row -->
<div class="row mb-5">
    <!-- Monthly Overview -->
    <div class="col-lg-6 mb-4">
        <div class="card table-card h-100 border-0 shadow-sm">
            <div class="card-header bg-gradient-info text-white border-0">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-chart-line me-2"></i>Monthly Overview
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center g-4">
                    <div class="col-6">
                        <div class="metric-card">
                            <div class="metric-icon bg-success mb-3">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                            <h3 class="text-success mb-1 fw-bold">{{ $monthlyOrders ?? 0 }}</h3>
                            <small class="text-muted fw-medium">Orders This Month</small>
                            <div class="metric-change mt-2">
                                <i class="fas fa-arrow-up text-success me-1"></i>
                                <span class="text-success fw-bold">+18%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="metric-card">
                            <div class="metric-icon bg-primary mb-3">
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                            <h3 class="text-primary mb-1 fw-bold">${{ number_format($monthlyRevenue ?? 0, 2) }}</h3>
                            <small class="text-muted fw-medium">Revenue This Month</small>
                            <div class="metric-change mt-2">
                                <i class="fas fa-arrow-up text-success me-1"></i>
                                <span class="text-success fw-bold">+24%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Customers -->
    <div class="col-lg-6 mb-4">
        <div class="card table-card h-100 border-0 shadow-sm">
            <div class="card-header bg-gradient-warning text-white border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-users me-2"></i>Top Customers
                        </h6>
                        <small class="opacity-75">Highest spending customers</small>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-eye me-1"></i>View All
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(isset($topCustomers) && $topCustomers->count() > 0)
                    <div class="customer-list">
                        @foreach($topCustomers->take(4) as $index => $customer)
                        <div class="customer-item d-flex align-items-center justify-content-between mb-3 pb-3 {{ $loop->last ? '' : 'border-bottom border-light' }}">
                            <div class="d-flex align-items-center">
                                <div class="customer-rank bg-{{ ['primary', 'success', 'warning', 'info'][$index % 4] }} text-white me-3" style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    {{ $index + 1 }}
                                </div>
                                <div class="customer-info">
                                    <h6 class="mb-0 fw-bold">{{ $customer->name }}</h6>
                                    <small class="text-muted">{{ $customer->orders_count }} orders</small>
                                </div>
                            </div>
                            <div class="customer-spent text-end">
                                <span class="fw-bold text-success">${{ number_format($customer->total_spent, 2) }}</span>
                                <small class="text-muted d-block">spent</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="empty-state">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted mb-2">No customer data</h6>
                            <p class="text-muted small">Customer information will appear here once orders are placed.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Activity Feed -->
<div class="row">
    <div class="col-12">
        <div class="card table-card border-0 shadow-sm">
            <div class="card-header bg-gradient-dark text-white border-0">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-history me-2"></i>Recent Activity
                </h6>
            </div>
            <div class="card-body">
                <div class="activity-timeline">
                    <div class="activity-item d-flex mb-4">
                        <div class="activity-icon bg-success me-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1 fw-medium">New user registered</p>
                            <small class="text-muted">John Doe joined your store • 2 hours ago</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex mb-4">
                        <div class="activity-icon bg-primary me-3">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1 fw-medium">New order placed</p>
                            <small class="text-muted">Order #1234 for $299.99 • 4 hours ago</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex mb-4">
                        <div class="activity-icon bg-warning me-3">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1 fw-medium">Product updated</p>
                            <small class="text-muted">iPhone 15 Pro Max stock updated • 6 hours ago</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex">
                        <div class="activity-icon bg-info me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1 fw-medium">Category created</p>
                            <small class="text-muted">New "Accessories" category added • 1 day ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
