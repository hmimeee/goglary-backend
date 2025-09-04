@extends('admin.layouts.app')

@section('title', 'Roles Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="table-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Roles Management</h4>
                        <a href="{{ route('roles.create') }}" class="btn btn-goglary">
                            <i class="fas fa-plus me-2"></i>Add New Role
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Permissions Count</th>
                                    <th>Users Count</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>
                                        <div class="fw-bold">#{{ $role->id }}</div>
                                    </td>
                                    <td class="fw-bold text-capitalize">
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $role->permissions->count() }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $role->users->count() }}</span>
                                    </td>
                                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-btn-group" role="group" aria-label="Role actions">
                                            <a href="{{ route('roles.show', $role) }}" class="btn action-btn view" title="View Role">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($role->name !== 'super-admin')
                                            <a href="{{ route('roles.edit', $role) }}" class="btn action-btn edit" title="Edit Role">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('roles.destroy', $role) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn action-btn delete" title="Delete Role"
                                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-user-shield fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No roles found</h5>
                                        <p class="text-muted">Start by creating your first role.</p>
                                        <a href="{{ route('roles.create') }}" class="btn btn-goglary">
                                            <i class="fas fa-plus me-2"></i>Add New Role
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($roles->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Roles pagination">
                            <ul class="pagination pagination-goglary">
                                {{-- Previous Page Link --}}
                                @if ($roles->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $roles->previousPageUrl() }}" rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                    @if ($page == $roles->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($roles->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $roles->nextPageUrl() }}" rel="next">
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
