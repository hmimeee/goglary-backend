@extends('admin.layouts.app')

@section('title', 'Brands Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="table-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Brands Management</h4>
                        @can('create brands')
                        <a href="{{ route('brands.create') }}" class="btn btn-goglary">
                            <i class="fas fa-plus me-2"></i>Add New Brand
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Brand Name</th>
                                    <th>Description</th>
                                    <th>Products Count</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $brand)
                                <tr>
                                    <td>
                                        @if($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 8px;">
                                                <i class="fas fa-image text-muted fa-lg"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $brand->name }}</div>
                                        <small class="text-muted">{{ Str::limit($brand->description, 50) }}</small>
                                    </td>
                                    <td>{{ $brand->products_count ?? 0 }}</td>
                                    <td>
                                        @if($brand->is_active)
                                            <span class="badge badge-goglary">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-btn-group" role="group" aria-label="Brand actions">
                                            <a href="{{ route('brands.show', $brand) }}" class="btn action-btn view" title="View Brand">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @can('edit brands')
                                            <a href="{{ route('brands.edit', $brand) }}" class="btn action-btn edit" title="Edit Brand">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete brands')
                                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn action-btn delete" title="Delete Brand" onclick="return confirm('Are you sure you want to delete this brand?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-copyright fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No brands found</h5>
                                        <p class="text-muted">Start by creating your first brand.</p>
                                        @can('create brands')
                                        <a href="{{ route('brands.create') }}" class="btn btn-goglary">
                                            <i class="fas fa-plus me-2"></i>Add New Brand
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($brands->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Brands pagination">
                            <ul class="pagination pagination-goglary">
                                {{-- Previous Page Link --}}
                                @if ($brands->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $brands->previousPageUrl() }}" rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                                    @if ($page == $brands->currentPage())
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
                                @if ($brands->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $brands->nextPageUrl() }}" rel="next">
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

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush
@endsection
