<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Waiter;

class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample waiters with PIN codes
        $waiters = [
            [
                'name' => 'Granit',
                'pin_code' => '1234'
            ],
            [
                'name' => 'Demo Waiter',
                'pin_code' => '5678'
            ],
            [
                'name' => 'John Smith',
                'pin_code' => '1111'
            ],
            [
                'name' => 'Sarah Johnson',
                'pin_code' => '2222'
            ],
            [
                'name' => 'Mike Wilson',
                'pin_code' => '3333'
            ],
            [
                'name' => 'Lisa Brown',
                'pin_code' => '4444'
            ]
        ];

        foreach ($waiters as $waiter) {
            Waiter::updateOrCreate(
                ['pin_code' => $waiter['pin_code']],
                $waiter
            );
        }

        $this->command->info('Waiters seeded successfully!');
        $this->command->info('Sample PIN codes:');
        foreach ($waiters as $waiter) {
            $this->command->info("- {$waiter['name']}: {$waiter['pin_code']}");
        }
    }
}
