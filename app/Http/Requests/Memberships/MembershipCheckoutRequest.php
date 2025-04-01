<?php

namespace App\Http\Requests\Memberships;

use Illuminate\Foundation\Http\FormRequest;

class MembershipCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price_id'   => 'required|exists:membership_prices,id',
            'start_date' => 'required|date|after_or_equal:today',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|exists:users,email',
        ];
    }
}
