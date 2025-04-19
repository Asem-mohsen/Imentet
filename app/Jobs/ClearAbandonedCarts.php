<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class ClearAbandonedCarts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function handle(): void
    {
        $this->cartService->clearAbandonedCarts(3);
    }
} 