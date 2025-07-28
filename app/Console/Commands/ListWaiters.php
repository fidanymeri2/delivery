<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Waiter;

class ListWaiters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'waiters:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all waiters';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $waiters = Waiter::all();
        
        $this->info('Available Waiters:');
        $this->table(
            ['ID', 'Name', 'PIN Code'],
            $waiters->map(function($waiter) {
                return [$waiter->id, $waiter->name, $waiter->pin_code];
            })->toArray()
        );
    }
}
