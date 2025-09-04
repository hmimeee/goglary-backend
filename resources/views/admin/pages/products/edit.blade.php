@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Edit Product: {{ $product->name }}</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="edit-product-form" action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Product Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label required">Price</label>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock_quantity" class="form-label required">Stock Quantity</label>
                                            <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                            @error('stock_quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label required">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="brand_id" class="form-label">Brand</label>
                                            <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="images" class="form-label required">Product Images</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Supported formats: JPG, PNG, GIF. Max size: 2MB each. You can select multiple images.</div>
                                </div>

                                <div id="image-preview" class="mb-3">
                                    <label class="form-label">Current Images</label>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Manage product images</small>
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearAllImages()">
                                            <i class="fas fa-trash"></i> Clear All
                                        </button>
                                    </div>
                                    <div class="border rounded p-2">
                                        @if($product->images && count($product->images) > 0)
                                            <div class="row g-2" id="existing-images">
                                                @foreach($product->images as $index => $image)
                                                    <div class="col-6 col-md-4">
                                                        <div class="position-relative image-container {{ $index === 0 ? 'primary-image' : '' }}" data-index="{{ $index }}">
                                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-btn" onclick="removeImage({{ $index }}, '{{ $image }}', this)" title="Remove image">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            @if($index === 0)
                                                                <span class="badge bg-primary position-absolute bottom-0 start-0 m-1">Primary</span>
                                                            @else
                                                                <button type="button" class="btn btn-outline-primary btn-sm position-absolute bottom-0 start-0 m-1" onclick="setPrimaryImage({{ $index }})" title="Set as primary">
                                                                    <i class="fas fa-star"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center text-muted py-4" id="no-images-placeholder">
                                                <i class="fas fa-image fa-3x"></i>
                                                <p>No images uploaded</p>
                                            </div>
                                        @endif
                                        <div id="new-images-preview" class="row g-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Product
                            </button>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">
                                <i class="fas fa-eye"></i> View Product
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
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
    // Multiple image preview - Add new images without replacing existing ones
    document.getElementById('images').addEventListener('change', function(e) {
        const files = e.target.files;
        const newImagesPreview = document.getElementById('new-images-preview');

        if (files.length > 0) {
            // Clear previous new images preview
            newImagesPreview.innerHTML = '<div class="col-12 mb-2"><small class="text-muted">New images to upload:</small></div>';

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const newImageHtml = `
                            <div class="col-6 col-md-4">
                                <div class="position-relative new-image-container" data-file-index="${index}">
                                    <img src="${e.target.result}" alt="New image ${index + 1}" class="img-fluid rounded">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">New</span>
                                    <button type="button" class="btn btn-warning btn-sm position-absolute bottom-0 end-0 m-1" onclick="removeNewImage(${index}, this)" title="Remove new image">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        newImagesPreview.insertAdjacentHTML('beforeend', newImageHtml);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            // Clear new images preview if no files selected
            newImagesPreview.innerHTML = '';
        }
    });

    // Clear all images function
    function clearAllImages() {
        if (confirm('Are you sure you want to clear all images? This will remove both existing and new images.')) {
            // Clear existing images
            const existingImages = document.getElementById('existing-images');
            if (existingImages) {
                existingImages.innerHTML = '';
            }

            // Clear new images
            const newImagesPreview = document.getElementById('new-images-preview');
            newImagesPreview.innerHTML = '';

            // Show placeholder
            const placeholder = document.getElementById('no-images-placeholder');
            if (placeholder) {
                placeholder.style.display = 'block';
            }

            // Clear file input
            document.getElementById('images').value = '';

            // Clear remove_images hidden input
            const form = document.querySelector('#edit-product-form');
            const removeInput = form.querySelector('input[name="remove_images"]');
            if (removeInput) {
                removeInput.remove();
            }

            // Clear primary_image hidden input
            const primaryInput = form.querySelector('input[name="primary_image"]');
            if (primaryInput) {
                primaryInput.remove();
            }
        }
    }

    // Remove new image function
    function removeNewImage(fileIndex, buttonElement) {
        const container = buttonElement.closest('.new-image-container');
        if (container) {
            container.parentElement.remove();
        }

        // Update the file input to remove the specific file
        const fileInput = document.getElementById('images');
        const dt = new DataTransfer();
        const files = Array.from(fileInput.files);

        // Remove the file at the specified index
        files.splice(fileIndex, 1);

        // Update file input with remaining files
        files.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;

        // If no new images left, clear the preview
        if (files.length === 0) {
            document.getElementById('new-images-preview').innerHTML = '';
        }
    }

    // Remove existing image function
    function removeImage(index, imagePath, buttonElement) {
        if (confirm('Are you sure you want to remove this image?')) {
            // Create a hidden input to track images to remove
            const form = document.querySelector('#edit-product-form');
            let removeInput = form.querySelector('input[name="remove_images"]');

            if (!removeInput) {
                removeInput = document.createElement('input');
                removeInput.type = 'hidden';
                removeInput.name = 'remove_images';
                form.appendChild(removeInput);
            }

            const currentValue = removeInput.value ? removeInput.value.split(',') : [];
            currentValue.push(index);
            removeInput.value = currentValue.join(',');

            // Remove the image from preview using the button element
            const imageContainer = buttonElement.closest('.col-6');
            if (imageContainer) {
                imageContainer.remove();

                // Hide placeholder if there are still images
                const existingImages = document.getElementById('existing-images');
                if (existingImages && existingImages.children.length === 0) {
                    const placeholder = document.getElementById('no-images-placeholder');
                    if (placeholder) {
                        placeholder.style.display = 'block';
                    }
                }
            } else {
                console.error('Could not find image container');
            }

            // Update remaining images' indices and buttons
            updateImageIndices();
        }
    }

    // Set primary image function
    function setPrimaryImage(index) {
        // Create a hidden input to track primary image index
        const form = document.querySelector('#edit-product-form');
        let primaryInput = form.querySelector('input[name="primary_image"]');

        if (!primaryInput) {
            primaryInput = document.createElement('input');
            primaryInput.type = 'hidden';
            primaryInput.name = 'primary_image';
            form.appendChild(primaryInput);
        }

        primaryInput.value = index;

        // Update UI to show new primary image in existing images only
        const existingImages = document.getElementById('existing-images');
        if (existingImages) {
            const imageContainers = existingImages.querySelectorAll('.image-container');
            imageContainers.forEach((container, i) => {
                const primaryBadge = container.querySelector('.badge');
                const primaryBtn = container.querySelector('.btn-outline-primary');

                if (i === index) {
                    container.classList.add('primary-image');
                    if (primaryBadge) primaryBadge.style.display = 'block';
                    if (primaryBtn) primaryBtn.style.display = 'none';
                } else {
                    container.classList.remove('primary-image');
                    if (primaryBadge) primaryBadge.style.display = 'none';
                    if (primaryBtn) primaryBtn.style.display = 'block';
                }
            });
        }

        alert('Primary image updated! Changes will be saved when you submit the form.');
    }

    // Update image indices after removal
    function updateImageIndices() {
        const existingImages = document.getElementById('existing-images');
        if (existingImages) {
            const imageContainers = existingImages.querySelectorAll('.image-container');
            imageContainers.forEach((container, newIndex) => {
                const removeBtn = container.querySelector('.remove-btn');
                const primaryBtn = container.querySelector('.btn-outline-primary');

                if (removeBtn) {
                    // Get the image path from the src attribute
                    const imgElement = container.querySelector('img');
                    if (imgElement) {
                        const imgSrc = imgElement.src;
                        // Extract the path after '/storage/'
                        const imagePath = imgSrc.substring(imgSrc.indexOf('/storage/') + 9);
                        removeBtn.setAttribute('onclick', `removeImage(${newIndex}, '${imagePath}', this)`);
                    }
                }
                if (primaryBtn) {
                    primaryBtn.setAttribute('onclick', `setPrimaryImage(${newIndex})`);
                }

                // Update primary image badge visibility
                const primaryBadge = container.querySelector('.badge');
                if (newIndex === 0) {
                    container.classList.add('primary-image');
                    if (primaryBadge) primaryBadge.style.display = 'block';
                    if (primaryBtn) primaryBtn.style.display = 'none';
                } else {
                    container.classList.remove('primary-image');
                    if (primaryBadge) primaryBadge.style.display = 'none';
                    if (primaryBtn) primaryBtn.style.display = 'block';
                }
            });
        }
    }
</script>
@endpush
@endsection
