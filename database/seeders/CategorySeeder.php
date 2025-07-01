<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Beverages',
                'description' => 'All types of drinks including soft drinks, juices, water, and energy drinks',
                'is_active' => true,
            ],
            [
                'name' => 'Snacks & Chips',
                'description' => 'Potato chips, crackers, nuts, and other snack foods',
                'is_active' => true,
            ],
            [
                'name' => 'Dairy Products',
                'description' => 'Milk, cheese, yogurt, and other dairy items',
                'is_active' => true,
            ],
            [
                'name' => 'Candy & Sweets',
                'description' => 'Chocolates, gummies, candies, and sweet treats',
                'is_active' => true,
            ],
            [
                'name' => 'Household Items',
                'description' => 'Cleaning supplies, toiletries, and household necessities',
                'is_active' => true,
            ],
            [
                'name' => 'Frozen Foods',
                'description' => 'Ice cream, frozen meals, and frozen snacks',
                'is_active' => true,
            ],
            [
                'name' => 'Bakery',
                'description' => 'Bread, pastries, and baked goods',
                'is_active' => true,
            ],
            [
                'name' => 'Personal Care',
                'description' => 'Shampoo, soap, toothpaste, and personal hygiene products',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
            echo "✅ Category created: {$category['name']}\n";
        }

        echo "\n";
    }
}