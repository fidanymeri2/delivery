<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantTable;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            // Hall 1 (Category ID 1) - 8 tables
            [
                'table_category_id' => 1,
                'table_number' => 'H1-01',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Window table with nice view',
                'sort_order' => 1,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-02',
                'status' => 'available',
                'capacity' => 6,
                'notes' => 'Large table for groups',
                'sort_order' => 2,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-03',
                'status' => 'occupied',
                'capacity' => 2,
                'notes' => 'Intimate table for couples',
                'sort_order' => 3,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-04',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Center table',
                'sort_order' => 4,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-05',
                'status' => 'reserved',
                'capacity' => 8,
                'notes' => 'Large round table for special occasions',
                'sort_order' => 5,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-06',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Quiet corner table',
                'sort_order' => 6,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-07',
                'status' => 'maintenance',
                'capacity' => 6,
                'notes' => 'Under maintenance - needs repair',
                'sort_order' => 7,
            ],
            [
                'table_category_id' => 1,
                'table_number' => 'H1-08',
                'status' => 'available',
                'capacity' => 2,
                'notes' => 'Bar counter seating',
                'sort_order' => 8,
            ],
            
            // Hall 2 (Category ID 2) - 6 tables
            [
                'table_category_id' => 2,
                'table_number' => 'H2-01',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Private dining area',
                'sort_order' => 1,
            ],
            [
                'table_category_id' => 2,
                'table_number' => 'H2-02',
                'status' => 'occupied',
                'capacity' => 6,
                'notes' => 'Family table',
                'sort_order' => 2,
            ],
            [
                'table_category_id' => 2,
                'table_number' => 'H2-03',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Standard table',
                'sort_order' => 3,
            ],
            [
                'table_category_id' => 2,
                'table_number' => 'H2-04',
                'status' => 'reserved',
                'capacity' => 10,
                'notes' => 'Large banquet table',
                'sort_order' => 4,
            ],
            [
                'table_category_id' => 2,
                'table_number' => 'H2-05',
                'status' => 'available',
                'capacity' => 2,
                'notes' => 'Cozy corner table',
                'sort_order' => 5,
            ],
            [
                'table_category_id' => 2,
                'table_number' => 'H2-06',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Window seat',
                'sort_order' => 6,
            ],
            
            // Teras (Category ID 3) - 4 tables
            [
                'table_category_id' => 3,
                'table_number' => 'T-01',
                'status' => 'available',
                'capacity' => 4,
                'notes' => 'Garden view table',
                'sort_order' => 1,
            ],
            [
                'table_category_id' => 3,
                'table_number' => 'T-02',
                'status' => 'occupied',
                'capacity' => 6,
                'notes' => 'Outdoor dining experience',
                'sort_order' => 2,
            ],
            [
                'table_category_id' => 3,
                'table_number' => 'T-03',
                'status' => 'available',
                'capacity' => 2,
                'notes' => 'Romantic outdoor table',
                'sort_order' => 3,
            ],
            [
                'table_category_id' => 3,
                'table_number' => 'T-04',
                'status' => 'reserved',
                'capacity' => 8,
                'notes' => 'Large outdoor gathering table',
                'sort_order' => 4,
            ],
        ];

        foreach ($tables as $table) {
            RestaurantTable::create($table);
        }
        
        $this->command->info('Restaurant tables seeded successfully!');
        $this->command->info('Created ' . count($tables) . ' tables across all categories.');
    }
}
