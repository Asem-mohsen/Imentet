<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        $user = Auth::user();

        return view('website.auth.profile',compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->updateUserProfile($user, $request->validated());

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    public function updateContact(UpdateUserRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        
        $this->userService->updateUserProfile($user, [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return response()->json(['message' => 'Contact information updated successfully']);
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        try {
            $user = User::find(Auth::id());
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }
            
            $user->phone = $request->phone;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Phone number updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update phone number',
            ], 500);
        }
    }
}
