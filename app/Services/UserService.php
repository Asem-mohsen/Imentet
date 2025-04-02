<?php 
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class UserService
{
    public function __construct(protected UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateUserProfile(User $user, array $data)
    {
        if (isset($data['dob'])) {
            $data['dob'] = Carbon::createFromFormat('m/d/Y', $data['dob'])->format('Y-m-d');
        }

        $updatedUser = $this->userRepository->updateUser($user, $data);

        if (isset($data['image'])) {
            $this->userRepository->updateProfileImage($updatedUser, $data['image']);
        }

        return $updatedUser;
    }
}