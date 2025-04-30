<?php 

namespace App\Services\Filament;
use App\Models\PaymentItem;
use Illuminate\Support\Facades\DB;
class Calculations
{
    public function getTotalAmountByPayableType(string $payableType): float
    {
        return PaymentItem::where('payable_type', $payableType)
            ->select(DB::raw('SUM(quantity * price) as total'))
            ->value('total') ?? 0;
    }

    public function getTotalAmountGroupedByDateAndPlace(string $payableType): \Illuminate\Support\Collection
    {
        return PaymentItem::query()
            ->selectRaw('DATE(created_at) as date, payable_id, SUM(quantity * price) as total_amount')
            ->where('payable_type', $payableType)
            ->groupBy('date', 'payable_id')
            ->get();
    }
}