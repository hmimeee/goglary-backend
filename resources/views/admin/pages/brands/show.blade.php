@extends('admin.layouts.app')

@section('title', 'Brand Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Brand Details</h4>
                        <div>
                            @can('edit brands')
                            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Edit Brand
                            </a>
                            @endcan
                            <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Brands
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Brand Logo</label>
                                <div class="border rounded p-3">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="img-fluid rounded">
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-image fa-4x"></i>
                                            <p class="mt-2">No logo uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Brand Name</label>
                                        <p class="form-control-plaintext">{{ $brand->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <p class="form-control-plaintext">
                                            <span class="badge bg-{{ $brand->is_active ? 'success' : 'secondary' }}">
                                                {{ $brand->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <p class="form-control-plaintext">{{ $brand->description ?: 'No description provided.' }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Website</label>
                                <p class="form-control-plaintext">
                                    @if($brand->website)
                                        <a href="{{ $brand->website }}" target="_blank" rel="noopener noreferrer">{{ $brand->website }}</a>
                                    @else
                                        No website provided.
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Products Count</label>
                                <p class="form-control-plaintext">{{ $brand->products_count ?? 0 }} products</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Created At</label>
                                        <p class="form-control-plaintext">{{ $brand->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="form-control-plaintext">{{ $brand->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($brand->products && $brand->products->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Products by this Brand</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brand->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($product->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('products.show', $product) }}" class="btn action-btn view">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
