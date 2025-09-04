<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Review::with(['user', 'product']);

        // Filter by product
        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'attachments' => $review->attachments,
                    'is_verified' => $review->is_verified,
                    'product' => $review->product ? [
                        'id' => $review->product->id,
                        'name' => $review->product->name,
                        'slug' => $review->product->slug,
                    ] : null,
                    'user' => $review->user ? [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                    ] : null,
                    'created_at' => $review->created_at,
                    'updated_at' => $review->updated_at,
                ];
            });

        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'attachments' => 'nullable|array',
            'is_verified' => 'boolean',
        ]);

        $review = Review::create($validated);

        // Update product rating
        $review->product->updateRating();

        return response()->json($review->load(['user', 'product']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): JsonResponse
    {
        $review->load(['user', 'product']);

        return response()->json([
            'id' => $review->id,
            'rating' => $review->rating,
            'comment' => $review->comment,
            'attachments' => $review->attachments,
            'is_verified' => $review->is_verified,
            'product' => $review->product ? [
                'id' => $review->product->id,
                'name' => $review->product->name,
                'slug' => $review->product->slug,
            ] : null,
            'user' => $review->user ? [
                'id' => $review->user->id,
                'name' => $review->user->name,
            ] : null,
            'created_at' => $review->created_at,
            'updated_at' => $review->updated_at,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review): JsonResponse
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'attachments' => 'nullable|array',
            'is_verified' => 'boolean',
        ]);

        $review->update($validated);

        // Update product rating
        $review->product->updateRating();

        return response()->json($review->load(['user', 'product']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): JsonResponse
    {
        $product = $review->product;
        $review->delete();

        // Update product rating after deletion
        $product->updateRating();

        return response()->json(['message' => 'Review deleted successfully']);
    }

    /**
     * Get reviews by product.
     */
    public function getByProduct(int $productId): JsonResponse
    {
        $reviews = Review::where('product_id', $productId)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'attachments' => $review->attachments,
                    'is_verified' => $review->is_verified,
                    'user' => $review->user ? [
                        'id' => $review->user->id,
                        'name' => $review->user->name,
                    ] : null,
                    'created_at' => $review->created_at,
                ];
            });

        return response()->json($reviews);
    }

    /**
     * Get reviews by user.
     */
    public function getByUser(int $userId): JsonResponse
    {
        $reviews = Review::where('user_id', $userId)
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'attachments' => $review->attachments,
                    'is_verified' => $review->is_verified,
                    'product' => $review->product ? [
                        'id' => $review->product->id,
                        'name' => $review->product->name,
                        'slug' => $review->product->slug,
                    ] : null,
                    'created_at' => $review->created_at,
                ];
            });

        return response()->json($reviews);
    }
}
