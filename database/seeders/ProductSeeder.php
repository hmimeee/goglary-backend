<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'The most advanced iPhone yet with titanium design and A17 Pro chip',
                'short_description' => 'Premium smartphone with advanced features',
                'price' => 999.00,
                'sale_price' => 949.00,
                'sku' => 'IPH15P-128',
                'stock_quantity' => 50,
                'in_stock' => true,
                'images' => ['/img/product_single_01.jpg', '/img/product_single_02.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => true,
                'rating' => 48, // Stored as integer (4.8 * 10)
                'review_count' => 25,
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'slug' => 'samsung-galaxy-s24',
                'description' => 'Premium Android smartphone with AI features',
                'short_description' => 'AI-powered Android smartphone',
                'price' => 799.00,
                'sale_price' => null,
                'sku' => 'SGS24-256',
                'stock_quantity' => 75,
                'in_stock' => true,
                'images' => ['/img/product_single_02.jpg', '/img/product_single_03.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => true,
                'rating' => 46, // Stored as integer (4.6 * 10)
                'review_count' => 30,
            ],
            [
                'name' => 'Nike Air Max 270',
                'slug' => 'nike-air-max-270',
                'description' => 'Comfortable running shoes with Air Max cushioning',
                'short_description' => 'Comfortable athletic shoes',
                'price' => 150.00,
                'sale_price' => 120.00,
                'sku' => 'NAM270-BLK',
                'stock_quantity' => 100,
                'in_stock' => true,
                'images' => ['/img/shop_01.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 3, // Nike
                'is_active' => true,
                'is_featured' => false,
                'rating' => 44, // Stored as integer (4.4 * 10)
                'review_count' => 15,
            ],
            [
                'name' => 'Adidas Ultraboost 23',
                'slug' => 'adidas-ultraboost-23',
                'description' => 'High-performance running shoes with Boost technology',
                'short_description' => 'Performance running shoes',
                'price' => 190.00,
                'sale_price' => null,
                'sku' => 'AUB23-WHT',
                'stock_quantity' => 80,
                'in_stock' => true,
                'images' => ['/img/shop_02.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 4, // Adidas
                'is_active' => true,
                'is_featured' => false,
                'rating' => 45, // Stored as integer (4.5 * 10)
                'review_count' => 20,
            ],
            [
                'name' => 'MacBook Pro 16"',
                'slug' => 'macbook-pro-16',
                'description' => 'Powerful laptop for professionals with M3 chip',
                'short_description' => 'Professional laptop with M3 chip',
                'price' => 2499.00,
                'sale_price' => 2299.00,
                'sku' => 'MBP16-M3',
                'stock_quantity' => 25,
                'in_stock' => true,
                'images' => ['/img/product_single_03.jpg', '/img/product_single_04.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => true,
                'rating' => 49, // Stored as integer (4.9 * 10)
                'review_count' => 35,
            ],
            [
                'name' => 'Wireless Bluetooth Headphones',
                'slug' => 'wireless-bluetooth-headphones',
                'description' => 'Premium wireless headphones with noise cancellation',
                'short_description' => 'Wireless noise-cancelling headphones',
                'price' => 299.00,
                'sale_price' => 249.00,
                'sku' => 'WBH-PRO',
                'stock_quantity' => 60,
                'in_stock' => true,
                'images' => ['/img/shop_03.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => false,
                'rating' => 43, // Stored as integer (4.3 * 10)
                'review_count' => 18,
            ],
            // Additional products for pagination testing
            [
                'name' => 'iPad Pro 12.9"',
                'slug' => 'ipad-pro-12-9',
                'description' => 'Professional tablet with M2 chip and Liquid Retina XDR display',
                'short_description' => 'Professional tablet with M2 chip',
                'price' => 1099.00,
                'sale_price' => null,
                'sku' => 'IPADPRO-129',
                'stock_quantity' => 30,
                'in_stock' => true,
                'images' => ['/img/product_single_04.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => true,
                'rating' => 47,
                'review_count' => 22,
            ],
            [
                'name' => 'Apple Watch Series 9',
                'slug' => 'apple-watch-series-9',
                'description' => 'Advanced smartwatch with health and fitness features',
                'short_description' => 'Advanced smartwatch',
                'price' => 399.00,
                'sale_price' => 349.00,
                'sku' => 'AW-S9-45',
                'stock_quantity' => 45,
                'in_stock' => true,
                'images' => ['/img/shop_04.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => false,
                'rating' => 45,
                'review_count' => 28,
            ],
            [
                'name' => 'Samsung Galaxy Tab S9',
                'slug' => 'samsung-galaxy-tab-s9',
                'description' => 'Premium Android tablet with S Pen included',
                'short_description' => 'Premium Android tablet',
                'price' => 799.00,
                'sale_price' => 699.00,
                'sku' => 'TAB-S9-128',
                'stock_quantity' => 35,
                'in_stock' => true,
                'images' => ['/img/shop_05.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => true,
                'rating' => 44,
                'review_count' => 19,
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'slug' => 'sony-wh-1000xm5',
                'description' => 'Industry-leading noise cancelling wireless headphones',
                'short_description' => 'Premium noise cancelling headphones',
                'price' => 349.00,
                'sale_price' => null,
                'sku' => 'WH1000XM5-BLK',
                'stock_quantity' => 40,
                'in_stock' => true,
                'images' => ['/img/shop_06.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung (generic electronics)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 46,
                'review_count' => 31,
            ],
            [
                'name' => 'Nike Air Force 1',
                'slug' => 'nike-air-force-1',
                'description' => 'Classic basketball shoes with iconic style',
                'short_description' => 'Classic basketball shoes',
                'price' => 110.00,
                'sale_price' => 90.00,
                'sku' => 'AF1-WHT',
                'stock_quantity' => 120,
                'in_stock' => true,
                'images' => ['/img/shop_07.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 3, // Nike
                'is_active' => true,
                'is_featured' => false,
                'rating' => 42,
                'review_count' => 45,
            ],
            [
                'name' => 'Adidas Stan Smith',
                'slug' => 'adidas-stan-smith',
                'description' => 'Timeless tennis shoes with clean design',
                'short_description' => 'Classic tennis shoes',
                'price' => 85.00,
                'sale_price' => null,
                'sku' => 'STAN-WHT',
                'stock_quantity' => 95,
                'in_stock' => true,
                'images' => ['/img/shop_08.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 4, // Adidas
                'is_active' => true,
                'is_featured' => false,
                'rating' => 41,
                'review_count' => 38,
            ],
            [
                'name' => 'Levi\'s 501 Original',
                'slug' => 'levis-501-original',
                'description' => 'Original straight fit jeans since 1873',
                'short_description' => 'Classic straight fit jeans',
                'price' => 89.00,
                'sale_price' => 69.00,
                'sku' => '501-ORIG',
                'stock_quantity' => 150,
                'in_stock' => true,
                'images' => ['/img/shop_09.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 3, // Nike (generic clothing)
                'is_active' => true,
                'is_featured' => true,
                'rating' => 43,
                'review_count' => 67,
            ],
            [
                'name' => 'H&M Cotton T-Shirt',
                'slug' => 'hm-cotton-t-shirt',
                'description' => 'Soft cotton t-shirt with comfortable fit',
                'short_description' => 'Comfortable cotton t-shirt',
                'price' => 19.99,
                'sale_price' => 14.99,
                'sku' => 'HM-TSHIRT-WHT',
                'stock_quantity' => 200,
                'in_stock' => true,
                'images' => ['/img/shop_10.jpg'],
                'category_id' => 2, // Clothing
                'brand_id' => 4, // Adidas (generic clothing)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 39,
                'review_count' => 23,
            ],
            [
                'name' => 'IKEA KIVIK Sofa',
                'slug' => 'ikea-kivik-sofa',
                'description' => 'Comfortable 2-seater sofa with removable covers',
                'short_description' => 'Comfortable 2-seater sofa',
                'price' => 449.00,
                'sale_price' => null,
                'sku' => 'KIVIK-2SEAT',
                'stock_quantity' => 25,
                'in_stock' => true,
                'images' => ['/img/shop_11.jpg'],
                'category_id' => 3, // Home & Garden
                'brand_id' => 1, // Apple (generic furniture)
                'is_active' => true,
                'is_featured' => true,
                'rating' => 44,
                'review_count' => 156,
            ],
            [
                'name' => 'Philips Air Fryer',
                'slug' => 'philips-air-fryer',
                'description' => 'Healthy cooking with rapid air technology',
                'short_description' => 'Healthy air fryer',
                'price' => 129.00,
                'sale_price' => 99.00,
                'sku' => 'AIRFRYER-4L',
                'stock_quantity' => 50,
                'in_stock' => true,
                'images' => ['/img/product_single_05.jpg'],
                'category_id' => 3, // Home & Garden
                'brand_id' => 2, // Samsung (generic appliances)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 45,
                'review_count' => 89,
            ],
            [
                'name' => 'Bosch Drill Set',
                'slug' => 'bosch-drill-set',
                'description' => 'Professional cordless drill with battery and bits',
                'short_description' => 'Professional cordless drill',
                'price' => 149.00,
                'sale_price' => null,
                'sku' => 'DRILL-PRO-18V',
                'stock_quantity' => 30,
                'in_stock' => true,
                'images' => ['/img/product_single_06.jpg'],
                'category_id' => 3, // Home & Garden
                'brand_id' => 1, // Apple (generic tools)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 46,
                'review_count' => 42,
            ],
            [
                'name' => 'Yardley Garden Hose',
                'slug' => 'yardley-garden-hose',
                'description' => 'Flexible garden hose with spray nozzle',
                'short_description' => 'Flexible garden hose',
                'price' => 29.99,
                'sale_price' => 24.99,
                'sku' => 'HOSE-25M',
                'stock_quantity' => 75,
                'in_stock' => true,
                'images' => ['/img/product_single_07.jpg'],
                'category_id' => 3, // Home & Garden
                'brand_id' => 2, // Samsung (generic garden)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 40,
                'review_count' => 15,
            ],
            [
                'name' => 'Peloton Bike',
                'slug' => 'peloton-bike',
                'description' => 'Interactive fitness bike with HD touchscreen',
                'short_description' => 'Interactive fitness bike',
                'price' => 2495.00,
                'sale_price' => 1995.00,
                'sku' => 'PELOTON-BIKE',
                'stock_quantity' => 10,
                'in_stock' => true,
                'images' => ['/img/product_single_08.jpg'],
                'category_id' => 4, // Sports & Outdoors
                'brand_id' => 3, // Nike (fitness)
                'is_active' => true,
                'is_featured' => true,
                'rating' => 48,
                'review_count' => 203,
            ],
            [
                'name' => 'Yoga Mat Premium',
                'slug' => 'yoga-mat-premium',
                'description' => 'Non-slip yoga mat with carrying strap',
                'short_description' => 'Non-slip yoga mat',
                'price' => 39.99,
                'sale_price' => null,
                'sku' => 'YOGA-MAT-6MM',
                'stock_quantity' => 100,
                'in_stock' => true,
                'images' => ['/img/product_single_09.jpg'],
                'category_id' => 4, // Sports & Outdoors
                'brand_id' => 4, // Adidas (fitness)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 42,
                'review_count' => 78,
            ],
            [
                'name' => 'Dumbbell Set 20kg',
                'slug' => 'dumbbell-set-20kg',
                'description' => 'Adjustable dumbbell set for home workouts',
                'short_description' => 'Adjustable dumbbell set',
                'price' => 79.99,
                'sale_price' => 59.99,
                'sku' => 'DUMBBELL-20KG',
                'stock_quantity' => 40,
                'in_stock' => true,
                'images' => ['/img/product_single_10.jpg'],
                'category_id' => 4, // Sports & Outdoors
                'brand_id' => 3, // Nike (fitness)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 44,
                'review_count' => 56,
            ],
            [
                'name' => 'Camping Tent 4-Person',
                'slug' => 'camping-tent-4-person',
                'description' => 'Waterproof camping tent for 4 people',
                'short_description' => 'Waterproof camping tent',
                'price' => 149.00,
                'sale_price' => 119.00,
                'sku' => 'TENT-4P-WATER',
                'stock_quantity' => 25,
                'in_stock' => true,
                'images' => ['/img/shop_01.jpg'],
                'category_id' => 4, // Sports & Outdoors
                'brand_id' => 4, // Adidas (outdoor)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 43,
                'review_count' => 34,
            ],
            [
                'name' => 'The Great Gatsby',
                'slug' => 'the-great-gatsby',
                'description' => 'Classic American novel by F. Scott Fitzgerald',
                'short_description' => 'Classic American literature',
                'price' => 12.99,
                'sale_price' => null,
                'sku' => 'BOOK-GATSBY',
                'stock_quantity' => 150,
                'in_stock' => true,
                'images' => ['/img/shop_02.jpg'],
                'category_id' => 5, // Books & Media
                'brand_id' => 1, // Apple (generic books)
                'is_active' => true,
                'is_featured' => true,
                'rating' => 45,
                'review_count' => 89,
            ],
            [
                'name' => 'Kindle Paperwhite',
                'slug' => 'kindle-paperwhite',
                'description' => 'Waterproof e-reader with 6.8" display',
                'short_description' => 'Waterproof e-reader',
                'price' => 139.00,
                'sale_price' => 119.00,
                'sku' => 'KINDLE-PW-11',
                'stock_quantity' => 60,
                'in_stock' => true,
                'images' => ['/img/shop_03.jpg'],
                'category_id' => 5, // Books & Media
                'brand_id' => 1, // Apple (Amazon)
                'is_active' => true,
                'is_featured' => true,
                'rating' => 46,
                'review_count' => 145,
            ],
            [
                'name' => 'Bluetooth Speaker',
                'slug' => 'bluetooth-speaker',
                'description' => 'Portable wireless speaker with 360° sound',
                'short_description' => 'Portable wireless speaker',
                'price' => 49.99,
                'sale_price' => 39.99,
                'sku' => 'SPEAKER-BT-PORT',
                'stock_quantity' => 80,
                'in_stock' => true,
                'images' => ['/img/shop_04.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => false,
                'rating' => 42,
                'review_count' => 67,
            ],
            [
                'name' => 'Coffee Maker Deluxe',
                'slug' => 'coffee-maker-deluxe',
                'description' => 'Programmable coffee maker with thermal carafe',
                'short_description' => 'Programmable coffee maker',
                'price' => 89.99,
                'sale_price' => null,
                'sku' => 'COFFEE-MAKER-12C',
                'stock_quantity' => 45,
                'in_stock' => true,
                'images' => ['/img/shop_05.jpg'],
                'category_id' => 3, // Home & Garden
                'brand_id' => 2, // Samsung (appliances)
                'is_active' => true,
                'is_featured' => false,
                'rating' => 43,
                'review_count' => 92,
            ],
            [
                'name' => 'Running Shoes Pro',
                'slug' => 'running-shoes-pro',
                'description' => 'Lightweight running shoes with advanced cushioning',
                'short_description' => 'Lightweight running shoes',
                'price' => 129.99,
                'sale_price' => 99.99,
                'sku' => 'RUNNING-PRO-BLK',
                'stock_quantity' => 70,
                'in_stock' => true,
                'images' => ['/img/shop_06.jpg'],
                'category_id' => 4, // Sports & Outdoors
                'brand_id' => 3, // Nike
                'is_active' => true,
                'is_featured' => false,
                'rating' => 44,
                'review_count' => 123,
            ],
            [
                'name' => 'Wireless Earbuds',
                'slug' => 'wireless-earbuds',
                'description' => 'True wireless earbuds with active noise cancellation',
                'short_description' => 'True wireless earbuds',
                'price' => 179.99,
                'sale_price' => 149.99,
                'sku' => 'EARBUDS-TWS-ANC',
                'stock_quantity' => 90,
                'in_stock' => true,
                'images' => ['/img/shop_07.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => true,
                'rating' => 45,
                'review_count' => 234,
            ],
            [
                'name' => 'Smart Watch Pro',
                'slug' => 'smart-watch-pro',
                'description' => 'Advanced smartwatch with health monitoring',
                'short_description' => 'Advanced smartwatch',
                'price' => 299.99,
                'sale_price' => null,
                'sku' => 'SMARTWATCH-PRO',
                'stock_quantity' => 55,
                'in_stock' => true,
                'images' => ['/img/shop_08.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => false,
                'rating' => 44,
                'review_count' => 156,
            ],
            [
                'name' => 'Gaming Headset',
                'slug' => 'gaming-headset',
                'description' => 'RGB gaming headset with surround sound',
                'short_description' => 'RGB gaming headset',
                'price' => 89.99,
                'sale_price' => 69.99,
                'sku' => 'HEADSET-GAMING-RGB',
                'stock_quantity' => 65,
                'in_stock' => true,
                'images' => ['/img/shop_09.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => false,
                'rating' => 43,
                'review_count' => 89,
            ],
            [
                'name' => 'Mechanical Keyboard',
                'slug' => 'mechanical-keyboard',
                'description' => 'RGB mechanical keyboard with blue switches',
                'short_description' => 'RGB mechanical keyboard',
                'price' => 129.99,
                'sale_price' => null,
                'sku' => 'KEYBOARD-MECH-RGB',
                'stock_quantity' => 40,
                'in_stock' => true,
                'images' => ['/img/shop_10.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => false,
                'rating' => 45,
                'review_count' => 67,
            ],
            [
                'name' => '4K Monitor 27"',
                'slug' => '4k-monitor-27',
                'description' => '27-inch 4K UHD monitor with HDR support',
                'short_description' => '27-inch 4K UHD monitor',
                'price' => 349.99,
                'sale_price' => 299.99,
                'sku' => 'MONITOR-4K-27',
                'stock_quantity' => 25,
                'in_stock' => true,
                'images' => ['/img/shop_11.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => true,
                'rating' => 46,
                'review_count' => 78,
            ],
            [
                'name' => 'Wireless Mouse',
                'slug' => 'wireless-mouse',
                'description' => 'Ergonomic wireless mouse with precision tracking',
                'short_description' => 'Ergonomic wireless mouse',
                'price' => 39.99,
                'sale_price' => null,
                'sku' => 'MOUSE-WIRELESS-ERG',
                'stock_quantity' => 120,
                'in_stock' => true,
                'images' => ['/img/product_single_01.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 1, // Apple
                'is_active' => true,
                'is_featured' => false,
                'rating' => 42,
                'review_count' => 45,
            ],
            [
                'name' => 'USB-C Hub',
                'slug' => 'usb-c-hub',
                'description' => '7-in-1 USB-C hub with HDMI, USB ports, and card reader',
                'short_description' => '7-in-1 USB-C hub',
                'price' => 49.99,
                'sale_price' => 39.99,
                'sku' => 'HUB-USBC-7IN1',
                'stock_quantity' => 85,
                'in_stock' => true,
                'images' => ['/img/product_single_02.jpg'],
                'category_id' => 1, // Electronics
                'brand_id' => 2, // Samsung
                'is_active' => true,
                'is_featured' => false,
                'rating' => 43,
                'review_count' => 123,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
