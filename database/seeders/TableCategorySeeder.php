<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TableCategory;

class TableCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hall 1',
                'description' => 'Main dining hall with indoor seating',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hall 2',
                'description' => 'Secondary dining hall with indoor seating',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Teras',
                'description' => 'Outdoor terrace seating area',
                'status' => 'active',
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            TableCategory::create($category);
        }
    }
}
