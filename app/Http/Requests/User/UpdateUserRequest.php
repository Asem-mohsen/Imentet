<?php 
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'dob' => 'nullable|date',
            'phone' => 'nullable|digits_between:7,15',
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
