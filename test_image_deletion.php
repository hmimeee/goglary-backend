<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Image Deletion Functionality\n";
echo "===================================\n\n";

// Get a product with multiple images
$product = Product::find(1); // iPhone 15 Pro with 2 images
echo "Original product images: " . json_encode($product->images) . "\n";

// Simulate form data for removing the first image (index 0)
$requestData = [
    'name' => $product->name,
    'slug' => $product->slug,
    'description' => $product->description,
    'price' => $product->price,
    'remove_images' => '0', // Remove first image
    // Add other required fields...
    'sku' => $product->sku,
    'stock_quantity' => $product->stock_quantity,
    'category_id' => $product->category_id,
    'brand_id' => $product->brand_id,
];

$request = new Request();
$request->merge($requestData);

// Simulate the controller logic
$currentImages = $product->images ?? [];
echo "Current images before processing: " . json_encode($currentImages) . "\n";
echo "Remove images request: " . $request->input('remove_images') . "\n";

if ($request->has('remove_images') && !empty($request->remove_images)) {
    $removeIndices = explode(',', $request->remove_images);
    echo "Remove indices: " . json_encode($removeIndices) . "\n";

    foreach ($removeIndices as $index) {
        if (isset($currentImages[$index])) {
            echo "Would delete image: " . $currentImages[$index] . "\n";
            // Note: Not actually deleting files in test
            unset($currentImages[$index]);
        }
    }
    // Reindex array
    $currentImages = array_values($currentImages);
    echo "Images after removal: " . json_encode($currentImages) . "\n";
}

echo "\nTest completed successfully!\n";
