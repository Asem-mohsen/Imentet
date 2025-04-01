<?php

namespace App\Http\Requests\Memberships;

use Illuminate\Foundation\Http\FormRequest;

class MembershipDocsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'is_egyptian' => 'required|boolean',
            'personal_id' => 'required|file|mimes:jpg,png,pdf',
            'personal_photo' => 'required|file|mimes:jpg,png',
            'passport' => [
                'nullable',
                'file',
                'mimes:jpg,png,pdf',
                function ($attribute, $value, $fail) {
                    if (!$this->boolean('is_egyptian') && !$value) {
                        $fail('The passport is required for non-Egyptians.');
                    }
                },
            ],
            'token' => 'required|string',
        ];
    }
}
