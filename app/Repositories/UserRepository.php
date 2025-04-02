<?php 
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function getOrCreateUser(string $email, string $firstName, string $lastName, ?string $phone = null)
    {
        return User::firstOrCreate(
            ['email' => $email], 
            [
                'first_name'=> $firstName,
                'last_name' => $lastName,
                'phone'     => $phone,
                'password'  => Hash::make(Str::random(16)),
                'role_id'   => config('roles.regular_user'),
                'status'    => 'active',
            ]
        );
    }

    public function createUser(array $data)
    {
        return User::create([
            'first_name'=> $data['first_name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'phone'     => $data['phone'] ?? null,
            'password'  => isset($data['password']) 
                ? Hash::make($data['password']) 
                : Hash::make(Str::random(16)),
            'role_id'   => $data['role_id'] ?? config('roles.regular_user'),
            'status'    => $data['status'] ?? 'active',
        ]);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'dob' => $data['dob'] ?? null,
            'phone' => $data['phone'] ?? null,
            'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);

        return $user;
    }

    public function updateProfileImage(User $user, $image)
    {
        $user->clearMediaCollection('user_profile_image');
        $user->addMedia($image)->toMediaCollection('user_profile_image');
    }
    
    public function findById(int $id)
    {
        return User::find($id);
    }

    public function findBy(array $where)
    {
        return User::when(!empty($where), function ($query) use ($where) {
            foreach ($where as $column => $condition) {
                if (is_array($condition) && isset($condition['operator'], $condition['value'])) {
                    $query->where($column, $condition['operator'], $condition['value']);
                } else {
                    $query->where($column, $condition);
                }
            }
        })->first();
    }

}