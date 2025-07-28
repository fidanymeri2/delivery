<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Beverages', 'description' => 'Hot and cold drinks'],
            ['name' => 'Main Course', 'description' => 'Main dishes and entrees'],
            ['name' => 'Appetizers', 'description' => 'Starters and snacks'],
            ['name' => 'Desserts', 'description' => 'Sweet treats and desserts'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create products with sizes and prices
        $products = [
            // Beverages
            [
                'category_id' => 1,
                'name' => 'Coffee',
                'description' => 'Fresh brewed coffee',
                'sizes' => [
                    ['size' => 'Small', 'price' => 3.50],
                    ['size' => 'Medium', 'price' => 4.50],
                    ['size' => 'Large', 'price' => 5.50],
                ]
            ],
            [
                'category_id' => 1,
                'name' => 'Tea',
                'description' => 'Hot tea selection',
                'sizes' => [
                    ['size' => 'Small', 'price' => 3.00],
                    ['size' => 'Medium', 'price' => 4.00],
                ]
            ],
            [
                'category_id' => 1,
                'name' => 'Orange Juice',
                'description' => 'Fresh squeezed orange juice',
                'sizes' => [
                    ['size' => 'Medium', 'price' => 4.50],
                    ['size' => 'Large', 'price' => 6.00],
                ]
            ],

            // Main Course
            [
                'category_id' => 2,
                'name' => 'Grilled Chicken',
                'description' => 'Grilled chicken breast with herbs',
                'sizes' => [
                    ['size' => 'Regular', 'price' => 18.50],
                    ['size' => 'Large', 'price' => 22.00],
                ]
            ],
            [
                'category_id' => 2,
                'name' => 'Beef Steak',
                'description' => 'Premium beef steak',
                'sizes' => [
                    ['size' => '8oz', 'price' => 25.00],
                    ['size' => '12oz', 'price' => 32.00],
                ]
            ],
            [
                'category_id' => 2,
                'name' => 'Pasta Carbonara',
                'description' => 'Classic pasta with cream sauce',
                'sizes' => [
                    ['size' => 'Regular', 'price' => 16.50],
                ]
            ],

            // Appetizers
            [
                'category_id' => 3,
                'name' => 'Bruschetta',
                'description' => 'Toasted bread with tomatoes and herbs',
                'sizes' => [
                    ['size' => 'Regular', 'price' => 8.50],
                ]
            ],
            [
                'category_id' => 3,
                'name' => 'Mozzarella Sticks',
                'description' => 'Crispy mozzarella sticks',
                'sizes' => [
                    ['size' => '6 pieces', 'price' => 7.50],
                    ['size' => '12 pieces', 'price' => 12.00],
                ]
            ],

            // Desserts
            [
                'category_id' => 4,
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert',
                'sizes' => [
                    ['size' => 'Regular', 'price' => 9.50],
                ]
            ],
            [
                'category_id' => 4,
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake',
                'sizes' => [
                    ['size' => 'Slice', 'price' => 7.50],
                ]
            ],
        ];

        foreach ($products as $productData) {
            $sizes = $productData['sizes'];
            unset($productData['sizes']);
            
            $product = Product::create($productData);
            
            foreach ($sizes as $sizeData) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $sizeData['size'],
                    'price' => $sizeData['price'],
                    'dimensions' => $sizeData['size'],
                ]);
            }
        }

        $this->command->info('Products seeded successfully!');
        $this->command->info('Created ' . count($products) . ' products with prices.');
    }
}
