<?php

namespace App\Console\Commands;

use App\Jobs\ClearAbandonedCarts;
use Illuminate\Console\Command;

class ClearAbandonedCartsCommand extends Command
{
    protected $signature = 'carts:clear-abandoned';
    protected $description = 'Clear abandoned carts older than 3 days';

    public function handle()
    {
        $this->info('Dispatching ClearAbandonedCarts job...');
        ClearAbandonedCarts::dispatch();
        $this->info('Job dispatched successfully!');
    }
} 