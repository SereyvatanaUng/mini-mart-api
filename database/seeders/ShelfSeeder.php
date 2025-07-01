<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Shelf;

class ShelfSeeder extends Seeder
{
    public function run()
    {
        $sections = Section::all();
        
        foreach ($sections as $section) {
            // Create 4 shelves per section (levels 1-4)
            for ($level = 1; $level <= 4; $level++) {
                $shelfNames = [
                    1 => 'Bottom Shelf',
                    2 => 'Middle Shelf',
                    3 => 'Eye Level Shelf',
                    4 => 'Top Shelf'
                ];

                $shelf = Shelf::create([
                    'name' => $shelfNames[$level],
                    'section_id' => $section->id,
                    'level' => $level,
                    'description' => "Level {$level} shelf in {$section->name}",
                    'is_active' => true,
                ]);

                echo "✅ Shelf created: {$section->name} - {$shelf->name} (Level {$level})\n";
            }
        }

        echo "\n";
    }
}