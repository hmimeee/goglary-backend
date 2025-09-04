@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Role: {{ $role->name }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>View Role
                            </a>
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Roles
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Role Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $role->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Enter a unique name for this role (e.g., admin, editor, moderator)</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;">
                                        @foreach($permissions as $group => $groupPermissions)
                                            <div class="mb-3">
                                                <h6 class="text-capitalize">{{ $group }} Permissions</h6>
                                                <div class="row">
                                                    @foreach($groupPermissions as $permission)
                                                        <div class="col-md-4 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                       name="permissions[]" value="{{ $permission->name }}"
                                                                       id="perm_{{ $permission->id }}"
                                                                       {{ in_array($permission->name, $rolePermissions ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                                    {{ ucfirst(str_replace(' ', ' ', $permission->name)) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Select the permissions you want to assign to this role</small>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-goglary">
                                        <i class="fas fa-save me-2"></i>Update Role
                                    </button>
                                    <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Role Statistics</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong>Users with this role:</strong>
                                            <span class="badge bg-primary ms-2">{{ $role->users->count() }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Current permissions:</strong>
                                            <span class="badge bg-info ms-2">{{ $role->permissions->count() }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Created:</strong>
                                            <br><small class="text-muted">{{ $role->created_at->format('M d, Y \a\t h:i A') }}</small>
                                        </div>
                                    </div>
                                </div>

                                @if($role->name !== 'super-admin')
                                <div class="card border-0 shadow-sm mt-3">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-exclamation-triangle me-2"></i>Danger Zone
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small mb-3">Once you delete this role, all users assigned to it will lose their permissions. This action cannot be undone.</p>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoleModal">
                                            <i class="fas fa-trash me-2"></i>Delete Role
                                        </button>
                                    </div>
                                </div>
                                @else
                                <div class="card border-0 shadow-sm mt-3">
                                    <div class="card-header bg-warning text-dark">
                                        <h6 class="mb-0">
                                            <i class="fas fa-shield-alt me-2"></i>Protected Role
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small">This is a system-protected role and cannot be deleted or have its name changed.</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>

                    @if($role->name !== 'super-admin')
                    <!-- Delete Role Modal -->
                    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete the role <strong>"{{ $role->name }}"</strong>?</p>
                                    <p class="text-danger">This will affect <strong>{{ $role->users->count() }} user(s)</strong> and cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash me-2"></i>Delete Role
                                        </button>
                                    </form>
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

@push('styles')
<style>
.form-check-input:checked {
    background-color: #59ab6e;
    border-color: #59ab6e;
}

.form-check-input:focus {
    border-color: #59ab6e;
    box-shadow: 0 0 0 0.2rem rgba(89, 171, 110, 0.25);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all permissions functionality
    const permissionsContainer = document.querySelector('.border.rounded.p-3');
    if (permissionsContainer) {
        // Create Select All button
        const selectAllBtn = document.createElement('button');
        selectAllBtn.type = 'button';
        selectAllBtn.className = 'btn btn-outline-primary btn-sm mb-3';
        selectAllBtn.innerHTML = '<i class="fas fa-check-square me-2"></i>Select All';

        // Add click handler
        selectAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });

            this.innerHTML = allChecked ?
                '<i class="fas fa-check-square me-2"></i>Select All' :
                '<i class="fas fa-square me-2"></i>Deselect All';
        });

        // Insert the button at the top of permissions section
        permissionsContainer.insertBefore(selectAllBtn, permissionsContainer.firstChild);
    }

    // Form validation enhancement
    const form = document.querySelector('form[action*="/roles/"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
            }
        });
    }
});
</script>
@endpush
@endsection
