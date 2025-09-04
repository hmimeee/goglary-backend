@extends('admin.layouts.app')

@section('title', 'View User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">User Details: {{ $user->name }}</h4>
                        <div class="d-flex gap-2 align-items-center">
                            <div class="action-btn-group" role="group" aria-label="User page actions">
                                @can('edit users')
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-2"></i>Edit User
                                    </a>
                                @endcan
                            </div>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Users
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Full Name</h6>
                                        <p class="mb-0 fw-bold">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Email Address</h6>
                                        <p class="mb-0 fw-bold">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">User ID</h6>
                                        <p class="mb-0 fw-bold">#{{ $user->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Status</h6>
                                        <p class="mb-0">
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <span class="badge bg-warning">Pending Verification</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Joined Date</h6>
                                        <p class="mb-0 fw-bold">{{ $user->created_at->format('M d, Y \a\t H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Last Updated</h6>
                                        <p class="mb-0 fw-bold">{{ $user->updated_at->format('M d, Y \a\t H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-3">Roles & Permissions</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        <span class="badge badge-goglary text-capitalize">{{ $role->name }}</span>
                                    @endforeach
                                    @if($user->roles->isEmpty())
                                        <span class="badge bg-secondary">No Role Assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">User Avatar</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                        style="width: 80px; height: 80px; font-size: 32px; border-radius: 12px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Quick Actions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @can('edit users')
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-2"></i>Edit User
                                            </a>
                                        @endcan
                                        @can('delete users')
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger w-100"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-trash me-2"></i>Delete User
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
