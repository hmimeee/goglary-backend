@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Create New Role</h4>
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Roles
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Role Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
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
                                                                       id="perm_{{ $permission->id }}">
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
                                    <small class="form-text text-muted">Select the permissions this role should have</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-goglary">
                                <i class="fas fa-save me-2"></i>Create Role
                            </button>
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all permissions for a group
    const groupHeaders = document.querySelectorAll('.border h6');

    groupHeaders.forEach(header => {
        header.style.cursor = 'pointer';
        header.addEventListener('click', function() {
            const groupDiv = this.parentElement;
            const checkboxes = groupDiv.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(cb => cb.checked = !allChecked);
        });
    });
});
</script>
@endpush
@endsection
