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
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'is_egyptian' => 'required|boolean',
            'personal_photo' => 'required|file|mimes:jpg,png',
            'token' => 'required|string',
        ];
    
        if ($this->boolean('is_egyptian')) {
            $rules['personal_id'] = 'required|file|mimes:jpg,png,pdf';
            $rules['passport'] = 'nullable|file|mimes:jpg,png,pdf';
        } else {
            $rules['passport'] = 'required|file|mimes:jpg,png,pdf';
            $rules['personal_id'] = 'nullable|file|mimes:jpg,png,pdf';
        }
    
        return $rules;
    }
    
}
