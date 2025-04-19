<?php 
namespace App\Repositories;

use App\Models\{Membership, UserMembership, MembershipPrice};

class MembershipRepository
{
    public function getAllMemberships(array $where = [], array $excludedNames = [])
    {
        return Membership::when(!empty($where), function ($query) use ($where) {
            foreach ($where as $column => $condition) {
                if (is_array($condition)) {
                    if (isset($condition['operator'], $condition['value'])) {
                        $query->where($column, $condition['operator'], $condition['value']);
                    }
                } else {
                    $query->where($column, $condition);
                }
            }
        })
        ->when(!empty($excludedNames), function ($query) use ($excludedNames) {
            $query->whereNotIn('name->en', $excludedNames);
        })
        ->get();
    }

    public function getAllUserMemberships(array $where = [], array $excludedNames = [])
    {
        return UserMembership::when(!empty($where), function ($query) use ($where) {
            foreach ($where as $column => $condition) {
                if (is_array($condition)) {
                    if (isset($condition['operator'], $condition['value'])) {
                        $query->where($column, $condition['operator'], $condition['value']);
                    }
                } else {
                    $query->where($column, $condition);
                }
            }
        })
        ->when(!empty($excludedNames), function ($query) use ($excludedNames) {
            $query->whereNotIn('name->en', $excludedNames);
        })
        ->get();
    }

    public function createUserMembership($userId, $membershipId, $priceId)
    {
        return UserMembership::create([
            'user_id' => $userId,
            'membership_id' => $membershipId,
            'price_id' => $priceId,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'status' => 'pending_documents',
            'document_submission_deadline' => now()->addWeek(), // 7 days deadline
        ]);
    }

    public function suspendMembership($userMembershipId)
    {
        $membership = UserMembership::find($userMembershipId);
        if ($membership && $membership->status === 'pending_documents' && now()->greaterThan($membership->document_submission_deadline)) {
            $membership->update(['status' => 'suspended']);
        }
    }

    public function findById(int $id)
    {
        return Membership::find($id);
    }

    public function findPriceById(int $id)
    {
        return MembershipPrice::find($id);
    }
    
}