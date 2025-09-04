@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
    <div class="container-fluid">
        <!-- User Statistics -->
        <div class="row mt-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card info h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->total() }}</h4>
                        <small class="text-muted">Total Users</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card success h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->where('email_verified_at', '!=', null)->count() }}</h4>
                        <small class="text-muted">Verified Users</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card warning h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->where('email_verified_at', null)->count() }}</h4>
                        <small class="text-muted">Pending Verification</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card primary h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h4 class="mb-1">
                            {{ $users->filter(function ($user) {return $user->roles->count() > 0;})->count() }}</h4>
                        <small class="text-muted">Users with Roles</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Users Management</h4>
                            @can('create users')
                                <a href="{{ route('users.create') }}" class="btn btn-goglary">
                                    <i class="fas fa-plus me-2"></i>Add New User
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">#{{ $user->id }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                        style="width: 40px; height: 40px; font-size: 16px; border-radius: 8px;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-goglary me-1">{{ $role->name }}</span>
                                                @endforeach
                                                @if ($user->roles->isEmpty())
                                                    <span class="badge bg-secondary">No Role</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->email_verified_at)
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @can('view users')
                                                        <a href="{{ route('users.show', $user) }}"
                                                            class="btn btn-sm btn-outline-primary" title="View User">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('edit users')
                                                        <a href="{{ route('users.edit', $user) }}"
                                                            class="btn btn-sm btn-outline-secondary" title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete users')
                                                        @if ($user->id !== auth()->id())
                                                            <form method="POST" action="{{ route('users.destroy', $user) }}"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    title="Delete User"
                                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No users found</h5>
                                                <p class="text-muted">Start by creating your first user.</p>
                                                @can('create users')
                                                    <a href="{{ route('users.create') }}" class="btn btn-goglary">
                                                        <i class="fas fa-plus me-2"></i>Add New User
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($users->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Users pagination">
                                    <ul class="pagination pagination-goglary">
                                        {{-- Previous Page Link --}}
                                        @if ($users->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                            @if ($page == $users->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($users->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .pagination-goglary .page-link {
                color: #59ab6e;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 6px !important;
                margin: 0 2px;
                transition: all 0.3s;
            }

            .pagination-goglary .page-link:hover {
                color: #56ae6c;
                background-color: #f8f9fa;
                border-color: #59ab6e;
            }

            .pagination-goglary .page-item.active .page-link {
                background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
                border-color: #59ab6e;
                color: white;
            }

            .pagination-goglary .page-item.disabled .page-link {
                color: #6c757d;
                background-color: #fff;
                border-color: #dee2e6;
            }

            .btn-group .btn {
                border-radius: 6px !important;
                margin-right: 2px;
            }

            .btn-group .btn:last-child {
                margin-right: 0;
            }

            .table tbody tr:hover {
                background-color: #f8f9fa;
            }

            .stats-card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .stats-card:hover {
                transform: translateY(-2px);
            }

            .stats-card.info {
                background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
                color: white;
            }

            .stats-card.success {
                background: linear-gradient(135deg, #28a745 0%, #218838 100%);
                color: white;
            }

            .stats-card.warning {
                background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
                color: white;
            }

            .stats-card.primary {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                color: white;
            }

            .stats-icon {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }
        </style>
    @endpush
@endsection
