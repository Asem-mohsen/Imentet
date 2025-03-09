<?php 
namespace App\Repositories;

use App\Models\Membership;

class MembershipRepository
{
    public function getAllMemberships()
    {
        return Membership::all();
    }

    public function createMembership(array $data)
    {
        return Membership::create($data);
    }

    public function deleteMembership(Membership $membership)
    {
        $membership->delete();
    }

    public function findById(int $id): ?Membership
    {
        return Membership::find($id);
    }
}