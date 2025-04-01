<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
}
