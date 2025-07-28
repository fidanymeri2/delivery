<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RestaurantTable;
use App\Models\TableCategory;

class ListTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tables:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all restaurant tables grouped by category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = TableCategory::with('tables')->get();
        
        foreach ($categories as $category) {
            $this->info("\n" . str_repeat('=', 50));
            $this->info("Category: {$category->name} (ID: {$category->id})");
            $this->info(str_repeat('=', 50));
            
            if ($category->tables->count() > 0) {
                $this->table(
                    ['Table Number', 'Status', 'Capacity', 'Notes'],
                    $category->tables->map(function ($table) {
                        return [
                            $table->table_number,
                            $table->status,
                            $table->capacity . ' seats',
                            $table->notes ?: '-'
                        ];
                    })->toArray()
                );
            } else {
                $this->warn('No tables found in this category.');
            }
        }
        
        $totalTables = RestaurantTable::count();
        $this->info("\n" . str_repeat('=', 50));
        $this->info("Total Tables: {$totalTables}");
        $this->info(str_repeat('=', 50));
    }
}
