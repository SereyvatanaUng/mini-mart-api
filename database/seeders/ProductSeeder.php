<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Section;
use App\Models\Shelf;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all()->keyBy('name');
        $sections = Section::all();
        $shelves = Shelf::all();

        $products = [
            // Beverages with image URLs
            [
                'name' => 'Coca Cola 330ml',
                'barcode' => '0049000028910',
                'description' => 'Classic Coca Cola soft drink, 330ml can',
                'price' => 1.50,
                'cost_price' => 0.90,
                'stock_quantity' => 120,
                'min_stock_level' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=400',
                'category' => 'Beverages',
                'section' => 'Front Section A',
                'shelf_level' => 3,
            ],
            [
                'name' => 'Pepsi 330ml',
                'barcode' => '0012000001765',
                'description' => 'Pepsi cola soft drink, 330ml can',
                'price' => 1.45,
                'cost_price' => 0.85,
                'stock_quantity' => 100,
                'min_stock_level' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1553456558-aff63285bdd1?w=400',
                'category' => 'Beverages',
                'section' => 'Front Section A',
                'shelf_level' => 3,
            ],
            [
                'name' => 'Bottled Water 500ml',
                'barcode' => '0035000521019',
                'description' => 'Pure spring water, 500ml bottle',
                'price' => 0.99,
                'cost_price' => 0.45,
                'stock_quantity' => 200,
                'min_stock_level' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400',
                'category' => 'Beverages',
                'section' => 'Front Section A',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Orange Juice 1L',
                'barcode' => '0041780003008',
                'description' => 'Fresh orange juice, 1 liter carton',
                'price' => 3.99,
                'cost_price' => 2.50,
                'stock_quantity' => 45,
                'min_stock_level' => 10,
                'image_url' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=400',
                'category' => 'Beverages',
                'section' => 'Cold Section D',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Energy Drink 250ml',
                'barcode' => '9002490100049',
                'description' => 'Red Bull energy drink, 250ml can',
                'price' => 2.99,
                'cost_price' => 1.80,
                'stock_quantity' => 75,
                'min_stock_level' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1572888962961-75ba26f30d6e?w=400',
                'category' => 'Beverages',
                'section' => 'Front Section A',
                'shelf_level' => 4,
            ],

            // Snacks & Chips with images
            [
                'name' => 'Lays Classic Chips',
                'barcode' => '0028400047180',
                'description' => 'Original flavor potato chips, family size',
                'price' => 3.49,
                'cost_price' => 2.10,
                'stock_quantity' => 60,
                'min_stock_level' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=400',
                'category' => 'Snacks & Chips',
                'section' => 'Middle Section B',
                'shelf_level' => 3,
            ],
            [
                'name' => 'Doritos Nacho Cheese',
                'barcode' => '0028400047365',
                'description' => 'Nacho cheese flavored tortilla chips',
                'price' => 3.99,
                'cost_price' => 2.40,
                'stock_quantity' => 50,
                'min_stock_level' => 12,
                'image_url' => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=400',
                'category' => 'Snacks & Chips',
                'section' => 'Middle Section B',
                'shelf_level' => 3,
            ],
            [
                'name' => 'Pringles Original',
                'barcode' => '0038000845006',
                'description' => 'Original flavor stackable potato crisps',
                'price' => 2.79,
                'cost_price' => 1.65,
                'stock_quantity' => 40,
                'min_stock_level' => 10,
                'image_url' => 'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?w=400',
                'category' => 'Snacks & Chips',
                'section' => 'Middle Section B',
                'shelf_level' => 2,
            ],

            // Dairy Products with images
            [
                'name' => 'Whole Milk 1L',
                'barcode' => '0070038349815',
                'description' => 'Fresh whole milk, 1 liter carton',
                'price' => 2.49,
                'cost_price' => 1.50,
                'stock_quantity' => 35,
                'min_stock_level' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?w=400',
                'category' => 'Dairy Products',
                'section' => 'Cold Section D',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Cheddar Cheese 200g',
                'barcode' => '0041220571253',
                'description' => 'Sharp cheddar cheese block, 200g',
                'price' => 4.29,
                'cost_price' => 2.80,
                'stock_quantity' => 25,
                'min_stock_level' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=400',
                'category' => 'Dairy Products',
                'section' => 'Cold Section D',
                'shelf_level' => 3,
            ],

            // Candy & Sweets with images
            [
                'name' => 'Snickers Bar',
                'barcode' => '0040000549352',
                'description' => 'Chocolate bar with peanuts and caramel',
                'price' => 1.29,
                'cost_price' => 0.75,
                'stock_quantity' => 90,
                'min_stock_level' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1511381939415-e44015466834?w=400',
                'category' => 'Candy & Sweets',
                'section' => 'Counter Section E',
                'shelf_level' => 1,
            ],
            [
                'name' => 'Kit Kat 4-Pack',
                'barcode' => '0034000172018',
                'description' => 'Wafer chocolate bars, 4-pack',
                'price' => 2.99,
                'cost_price' => 1.80,
                'stock_quantity' => 55,
                'min_stock_level' => 12,
                'image_url' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400',
                'category' => 'Candy & Sweets',
                'section' => 'Counter Section E',
                'shelf_level' => 2,
            ],

            // Personal Care with images
            [
                'name' => 'Shampoo 400ml',
                'barcode' => '0030878000258',
                'description' => 'Daily use shampoo for all hair types, 400ml',
                'price' => 4.99,
                'cost_price' => 3.10,
                'stock_quantity' => 30,
                'min_stock_level' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=400',
                'category' => 'Personal Care',
                'section' => 'Back Section C',
                'shelf_level' => 1,
            ],
            [
                'name' => 'Toothpaste 100ml',
                'barcode' => '0037000010104',
                'description' => 'Fluoride toothpaste for cavity protection, 100ml',
                'price' => 2.79,
                'cost_price' => 1.65,
                'stock_quantity' => 45,
                'min_stock_level' => 10,
                'image_url' => 'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=400',
                'category' => 'Personal Care',
                'section' => 'Back Section C',
                'shelf_level' => 2,
            ],
        ];

        foreach ($products as $productData) {
            // Get category
            $category = $categories->get($productData['category']);
            if (!$category) {
                echo "❌ Category not found: {$productData['category']}\n";
                continue;
            }

            // Get section
            $section = $sections->where('name', $productData['section'])->first();
            if (!$section) {
                echo "❌ Section not found: {$productData['section']}\n";
                continue;
            }

            // Get shelf
            $shelf = $shelves->where('section_id', $section->id)
                ->where('level', $productData['shelf_level'])
                ->first();
            if (!$shelf) {
                echo "❌ Shelf not found: {$productData['section']} Level {$productData['shelf_level']}\n";
                continue;
            }

            Product::create([
                'name' => $productData['name'],
                'barcode' => $productData['barcode'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'cost_price' => $productData['cost_price'],
                'stock_quantity' => $productData['stock_quantity'],
                'min_stock_level' => $productData['min_stock_level'],
                'image_url' => $productData['image_url'], // Add image URL
                'category_id' => $category->id,
                'section_id' => $section->id,
                'shelf_id' => $shelf->id,
                'is_active' => true,
            ]);

            echo "✅ Product created: {$productData['name']} with image\n";
        }

        echo "\n🎉 All products created with beautiful images!\n";
    }
}
