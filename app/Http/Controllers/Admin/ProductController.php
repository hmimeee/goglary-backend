<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->latest()
            ->paginate(15);

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $brands = Brand::active()->get();

        return view('admin.pages.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'stock_quantity' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_image' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->only([
            'name', 'description', 'price', 'category_id', 'brand_id',
            'stock_quantity', 'is_active'
        ]);

        // Set in_stock based on stock_quantity
        $data['in_stock'] = $data['stock_quantity'] > 0;

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $imagePath = $file->store('products', 'public');
                $uploadedImages[] = $imagePath;
            }
            $data['images'] = $uploadedImages;
        }

        $product = Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'reviews.user']);

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $brands = Brand::active()->get();

        return view('admin.pages.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'stock_quantity' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_images' => 'nullable|string',
            'primary_image' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ], [], [
            'name' => 'Product Name',
            'description' => 'Product Description',
            'price' => 'Product Price',
            'category_id' => 'Category',
            'brand_id' => 'Brand',
            'stock_quantity' => 'Stock Quantity',
            'images' => 'Product Images',
            'images.*' => 'Product Image '. (intval(':position') + 1),
            'remove_images' => 'Remove Images',
            'primary_image' => 'Primary Image',
            'is_active' => 'Active Status',
        ]);

        $data = $request->only([
            'name', 'description', 'price', 'category_id', 'brand_id',
            'stock_quantity', 'is_active'
        ]);

        // Set in_stock based on stock_quantity
        $data['in_stock'] = $data['stock_quantity'] > 0;

        // Handle image removal
        $currentImages = $product->images ?? [];

        if ($request->has('remove_images') && !empty($request->remove_images)) {
            $removeIndices = explode(',', $request->remove_images);

            foreach ($removeIndices as $index) {
                if (isset($currentImages[$index])) {
                    Storage::disk('public')->delete($currentImages[$index]);
                    unset($currentImages[$index]);
                }
            }
            // Reindex array
            $currentImages = array_values($currentImages);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $imagePath = $file->store('products', 'public');
                $uploadedImages[] = $imagePath;
            }

            // Combine existing images with new uploads
            $currentImages = array_merge($currentImages, $uploadedImages);
        }

        // Handle primary image setting
        if ($request->has('primary_image') && !empty($request->primary_image)) {
            $primaryIndex = (int) $request->primary_image;
            if (isset($currentImages[$primaryIndex])) {
                // Move the selected image to the front (make it primary)
                $primaryImage = $currentImages[$primaryIndex];
                unset($currentImages[$primaryIndex]);
                array_unshift($currentImages, $primaryImage);
            }
        }

        // Update images array
        if (!empty($currentImages)) {
            $data['images'] = array_values($currentImages);
        } elseif (empty($currentImages) && !$request->hasFile('images')) {
            // Keep existing images if no new images and no removals
            $data['images'] = $currentImages;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image files
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
