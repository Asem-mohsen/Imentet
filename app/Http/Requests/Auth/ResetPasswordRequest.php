<?php

namespace App\Http\Requests\Auth;;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8|confirmed|max:255',
        ];
    }
}
