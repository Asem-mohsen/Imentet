<?php 
namespace App\Repositories;

use App\Models\Donation;

class DonationRepository
{
    public function createDonation(array $data)
    {
        return Donation::create([
            'place_id' => $data['place_id'],
            'donor_name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'payment_method' => 'stripe',
            'message' => $data['message'] ?? null,
        ]);
    }

    public function findById($id)
    {
        return Donation::findOrFail($id);
    }
}