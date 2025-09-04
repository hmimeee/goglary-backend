<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'brand', 'reviews'])
            ->active()
            ->inStock();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if ($sortBy === 'price') {
            $query->orderBy('price', $sortOrder);
        } elseif ($sortBy === 'rating') {
            $query->orderBy('rating', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate($request->get('per_page', 12))->through(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'sku' => $product->sku,
                'stock_quantity' => $product->stock_quantity,
                'main_image' => $product->main_image,
                'images' => $product->images,
                'rating' => $product->rating,
                'reviews_count' => $product->reviews->count(),
                'category' => $product->category ? [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'slug' => $product->category->slug,
                ] : null,
                'brand' => $product->brand ? [
                    'id' => $product->brand->id,
                    'name' => $product->brand->name,
                    'slug' => $product->brand->slug,
                ] : null,
            ];
        });

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products',
            'stock_quantity' => 'required|integer|min:0',
            'main_image' => 'nullable|string',
            'images' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'attributes' => 'nullable|array',
        ]);

        $product = Product::create($validated);

        // Handle attributes if provided
        if (isset($validated['attributes'])) {
            foreach ($validated['attributes'] as $attribute) {
                $product->attributes()->create($attribute);
            }
        }

        return response()->json($product->load(['category', 'brand']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        $product->load(['category', 'brand', 'reviews.user', 'attributes']);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => $product->price,
            'sale_price' => $product->sale_price,
            'sku' => $product->sku,
            'stock_quantity' => $product->stock_quantity,
            'main_image' => $product->main_image,
            'images' => $product->images,
            'rating' => $product->rating,
            'is_active' => $product->is_active,
            'is_featured' => $product->is_featured,
            'category' => $product->category ? [
                'id' => $product->category->id,
                'name' => $product->category->name,
                'slug' => $product->category->slug,
            ] : null,
            'brand' => $product->brand ? [
                'id' => $product->brand->id,
                'name' => $product->brand->name,
                'slug' => $product->brand->slug,
            ] : null,
            'attributes' => $product->attributes->map(function ($attr) {
                return [
                    'id' => $attr->id,
                    'name' => $attr->name,
                    'value' => $attr->value,
                ];
            }),
            'reviews' => $product->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'attachments' => $review->attachments,
                    'user' => $review->user ? [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                    ] : null,
                    'created_at' => $review->created_at,
                ];
            }),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'required|integer|min:0',
            'main_image' => 'nullable|string',
            'images' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'attributes' => 'nullable|array',
        ]);

        $product->update($validated);

        // Handle attributes if provided
        if (isset($validated['attributes'])) {
            $product->attributes()->delete(); // Remove existing attributes
            foreach ($validated['attributes'] as $attribute) {
                $product->attributes()->create($attribute);
            }
        }

        return response()->json($product->load(['category', 'brand']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    /**
     * Search products by name.
     */
    public function search(string $query): JsonResponse
    {
        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->active()
            ->inStock()
            ->with(['category', 'brand'])
            ->limit(20)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'sale_price' => $product->sale_price,
                    'main_image' => $product->main_image,
                    'category' => $product->category ? $product->category->name : null,
                    'brand' => $product->brand ? $product->brand->name : null,
                ];
            });

        return response()->json($products);
    }

    /**
     * Get products by category.
     */
    public function getByCategory(int $categoryId): JsonResponse
    {
        $products = Product::where('category_id', $categoryId)
            ->active()
            ->inStock()
            ->with(['brand', 'reviews'])
            ->paginate(12)
            ->through(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'sale_price' => $product->sale_price,
                    'main_image' => $product->main_image,
                    'rating' => $product->rating,
                    'reviews_count' => $product->reviews->count(),
                    'brand' => $product->brand ? $product->brand->name : null,
                ];
            });

        return response()->json($products);
    }

    /**
     * Get products by brand.
     */
    public function getByBrand(int $brandId): JsonResponse
    {
        $products = Product::where('brand_id', $brandId)
            ->active()
            ->inStock()
            ->with(['category', 'reviews'])
            ->paginate(12)
            ->through(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'sale_price' => $product->sale_price,
                    'main_image' => $product->main_image,
                    'rating' => $product->rating,
                    'reviews_count' => $product->reviews->count(),
                    'category' => $product->category ? $product->category->name : null,
                ];
            });

        return response()->json($products);
    }
}
