<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $sections = [
            [
                'name' => 'Front Section A',
                'description' => 'Front entrance area - high traffic items',
                'position' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Middle Section B',
                'description' => 'Central area - main product displays',
                'position' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Back Section C',
                'description' => 'Back area - bulk items and storage',
                'position' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Cold Section D',
                'description' => 'Refrigerated and frozen items area',
                'position' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Counter Section E',
                'description' => 'Behind counter - tobacco, electronics, pharmacy',
                'position' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
            echo "✅ Section created: {$section['name']}\n";
        }

        echo "\n";
    }
}
