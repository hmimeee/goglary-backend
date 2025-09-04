@extends('admin.layouts.app')

@section('title', 'View Role')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Role Details: {{ $role->name }}</h4>
                        <div class="d-flex gap-2">
                            @if($role->name !== 'super-admin')
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-goglary">
                                <i class="fas fa-edit me-2"></i>Edit Role
                            </a>
                            @endif
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Roles
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Role Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Role Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Role ID:</strong>
                                        <span class="badge bg-primary ms-2">#{{ $role->id }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Role Name:</strong>
                                        <span class="ms-2">{{ $role->name }}</span>
                                        @if($role->name === 'super-admin')
                                            <span class="badge bg-danger ms-2">Super Admin</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <strong>Created Date:</strong>
                                        <span class="ms-2">{{ $role->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Last Updated:</strong>
                                        <span class="ms-2">{{ $role->updated_at->format('M d, Y \a\t h:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chart-bar me-2"></i>Statistics
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <div class="stats-card success mb-3">
                                                <div class="stats-icon">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <h4 class="mb-0">{{ $role->users->count() }}</h4>
                                                <small class="text-muted">Users</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stats-card info mb-3">
                                                <div class="stats-icon">
                                                    <i class="fas fa-key"></i>
                                                </div>
                                                <h4 class="mb-0">{{ $role->permissions->count() }}</h4>
                                                <small class="text-muted">Permissions</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions List -->
                    <div class="mt-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-shield-alt me-2"></i>Assigned Permissions
                                </h6>
                            </div>
                            <div class="card-body">
                                @if($role->permissions->count() > 0)
                                    <div class="row">
                                        @php
                                            $groupedPermissions = $role->permissions->groupBy(function ($permission) {
                                                return explode(' ', $permission->name)[1] ?? 'general';
                                            });
                                        @endphp

                                        @foreach($groupedPermissions as $group => $permissions)
                                            <div class="col-md-6 col-lg-4 mb-3">
                                                <div class="border rounded p-3">
                                                    <h6 class="text-capitalize mb-2">{{ $group }} Permissions</h6>
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($permissions as $permission)
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-check me-1"></i>{{ ucfirst(str_replace(' ', ' ', $permission->name)) }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No Permissions Assigned</h5>
                                        <p class="text-muted">This role doesn't have any permissions assigned yet.</p>
                                        @if($role->name !== 'super-admin')
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-goglary">
                                            <i class="fas fa-plus me-2"></i>Assign Permissions
                                        </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Users with this Role -->
                    @if($role->users->count() > 0)
                    <div class="mt-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-users me-2"></i>Users with this Role ({{ $role->users->count() }})
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Joined Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($role->users as $user)
                                            <tr>
                                                <td>#{{ $user->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-initial me-2">
                                                            {{ substr($user->name, 0, 1) }}
                                                        </div>
                                                        {{ $user->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
