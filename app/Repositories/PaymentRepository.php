<?php 
namespace App\Repositories;

use App\Models\{Payment, PaymentItem};

class PaymentRepository
{
    public function createPayment(array $data)
    {
        return Payment::create([
            'user_id' => $data['user_id'],
            'payment_method' => 'stripe',
            'amount' => $data['amount'],
            'status' => $data['status'],
            'transaction_id' => $data['transaction_id'],
        ]);
    }

    public function createPaymentItem(array $data)
    {
        return PaymentItem::create([
            'payment_id' => $data['payment_id'],
            'payable_type' => $data['payable_type'],
            'payable_id' => $data['payable_id'],
            'quantity' => 1,
            'price' => $data['price'],
        ]);
    }

    public function getPendingPayment($userId, $amount)
    {
        return Payment::where('user_id', $userId)
                      ->where('amount', $amount)
                      ->where('status', 'pending')
                      ->first();
    }

    public function updatePayment(Payment $payment, array $data)
    {
        return $payment->update($data);
    }
}