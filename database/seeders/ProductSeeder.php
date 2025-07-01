<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            // Beverages
            [
                'name' => 'Coca Cola 330ml',
                'barcode' => '0049000028910',
                'description' => 'Classic Coca Cola soft drink, 330ml can',
                'price' => 1.50,
                'cost_price' => 0.90,
                'stock_quantity' => 120,
                'min_stock_level' => 20,
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
                'category' => 'Beverages',
                'section' => 'Front Section A',
                'shelf_level' => 4,
            ],

            // Snacks & Chips
            [
                'name' => 'Lays Classic Chips',
                'barcode' => '0028400047180',
                'description' => 'Original flavor potato chips, family size',
                'price' => 3.49,
                'cost_price' => 2.10,
                'stock_quantity' => 60,
                'min_stock_level' => 15,
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
                'category' => 'Snacks & Chips',
                'section' => 'Middle Section B',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Mixed Nuts 200g',
                'barcode' => '0041129421051',
                'description' => 'Roasted mixed nuts, 200g pack',
                'price' => 4.99,
                'cost_price' => 3.20,
                'stock_quantity' => 30,
                'min_stock_level' => 8,
                'category' => 'Snacks & Chips',
                'section' => 'Middle Section B',
                'shelf_level' => 4,
            ],

            // Dairy Products
            [
                'name' => 'Whole Milk 1L',
                'barcode' => '0070038349815',
                'description' => 'Fresh whole milk, 1 liter carton',
                'price' => 2.49,
                'cost_price' => 1.50,
                'stock_quantity' => 35,
                'min_stock_level' => 8,
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
                'category' => 'Dairy Products',
                'section' => 'Cold Section D',
                'shelf_level' => 3,
            ],
            [
                'name' => 'Greek Yogurt 500g',
                'barcode' => '0052159200015',
                'description' => 'Plain Greek yogurt, 500g container',
                'price' => 3.79,
                'cost_price' => 2.30,
                'stock_quantity' => 20,
                'min_stock_level' => 5,
                'category' => 'Dairy Products',
                'section' => 'Cold Section D',
                'shelf_level' => 1,
            ],

            // Candy & Sweets
            [
                'name' => 'Snickers Bar',
                'barcode' => '0040000549352',
                'description' => 'Chocolate bar with peanuts and caramel',
                'price' => 1.29,
                'cost_price' => 0.75,
                'stock_quantity' => 90,
                'min_stock_level' => 20,
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
                'category' => 'Candy & Sweets',
                'section' => 'Counter Section E',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Gummy Bears 250g',
                'barcode' => '0041420061301',
                'description' => 'Haribo gummy bears, 250g bag',
                'price' => 2.49,
                'cost_price' => 1.45,
                'stock_quantity' => 40,
                'min_stock_level' => 10,
                'category' => 'Candy & Sweets',
                'section' => 'Middle Section B',
                'shelf_level' => 1,
            ],

            // Household Items
            [
                'name' => 'Paper Towels 6-Pack',
                'barcode' => '0037000273912',
                'description' => 'Absorbent paper towels, 6-roll pack',
                'price' => 8.99,
                'cost_price' => 5.50,
                'stock_quantity' => 25,
                'min_stock_level' => 5,
                'category' => 'Household Items',
                'section' => 'Back Section C',
                'shelf_level' => 4,
            ],
            [
                'name' => 'Dish Soap 500ml',
                'barcode' => '0037000326809',
                'description' => 'Liquid dish washing soap, 500ml bottle',
                'price' => 2.99,
                'cost_price' => 1.75,
                'stock_quantity' => 35,
                'min_stock_level' => 8,
                'category' => 'Household Items',
                'section' => 'Back Section C',
                'shelf_level' => 2,
            ],
            [
                'name' => 'Toilet Paper 12-Pack',
                'barcode' => '0037000087519',
                'description' => 'Soft toilet paper, 12-roll pack',
                'price' => 12.99,
                'cost_price' => 8.50,
                'stock_quantity' => 18,
                'min_stock_level' => 4,
                'category' => 'Household Items',
                'section' => 'Back Section C',
                'shelf_level' => 3,
            ],

            // Frozen Foods
            [
                'name' => 'Vanilla Ice Cream 1L',
                'barcode' => '0070330000328',
                'description' => 'Premium vanilla ice cream, 1 liter tub',
                'price' => 5.99,
                'cost_price' => 3.75,
                'stock_quantity' => 15,
                'min_stock_level' => 3,
                'category' => 'Frozen Foods',
                'section' => 'Cold Section D',
                'shelf_level' => 1,
            ],
            [
                'name' => 'Frozen Pizza',
                'barcode' => '0071921000523',
                'description' => 'Pepperoni frozen pizza, family size',
                'price' => 6.49,
                'cost_price' => 4.20,
                'stock_quantity' => 12,
                'min_stock_level' => 3,
                'category' => 'Frozen Foods',
                'section' => 'Cold Section D',
                'shelf_level' => 2,
            ],

            // Personal Care
            [
                'name' => 'Shampoo 400ml',
                'barcode' => '0030878000258',
                'description' => 'Daily use shampoo for all hair types, 400ml',
                'price' => 4.99,
                'cost_price' => 3.10,
                'stock_quantity' => 30,
                'min_stock_level' => 6,
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
                'category_id' => $category->id,
                'section_id' => $section->id,
                'shelf_id' => $shelf->id,
                'is_active' => true,
            ]);

            echo "✅ Product created: {$productData['name']} - {$section->name}, Level {$productData['shelf_level']}\n";
        }

        echo "\n";
    }
}
