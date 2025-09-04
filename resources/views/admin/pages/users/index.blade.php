@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
    <div class="container-fluid">
        <!-- User Statistics -->
        <div class="row mt-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card stats-card--gradient info h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->total() }}</h4>
                        <small class="text-white">Total Users</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card stats-card--gradient success h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->where('email_verified_at', '!=', null)->count() }}</h4>
                        <small class="text-white">Verified Users</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card stats-card--gradient warning h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="mb-1">{{ $users->where('email_verified_at', null)->count() }}</h4>
                        <small class="text-white">Pending Verification</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card stats-card stats-card--gradient primary h-100">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h4 class="mb-1">
                            {{ $users->filter(function ($user) {return $user->roles->count() > 0;})->count() }}</h4>
                        <small class="text-white">Users with Roles</small>
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
                                                    <div class="bg-primary text-white d-flex align-items-center justify-content-center me-3 avatar-initial">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                        <small class="text-white">{{ $user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-goglary me-1 text-capitalize">{{ $role->name }}</span>
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
                                                <div class="action-btn-group" role="group" aria-label="User actions">
                                                    @can('view users')
                                                        <a href="{{ route('users.show', $user) }}" class="btn action-btn view" title="View User">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('edit users')
                                                        <a href="{{ route('users.edit', $user) }}" class="btn action-btn edit" title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete users')
                                                        @if ($user->id !== auth()->id())
                                                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn action-btn delete" title="Delete User"
                                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button type="button" class="btn action-btn delete" title="Cannot delete your own account" disabled>
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <i class="fas fa-users fa-3x text-white mb-3"></i>
                                                <h5 class="text-white">No users found</h5>
                                                <p class="text-white">Start by creating your first user.</p>
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
@endsection
