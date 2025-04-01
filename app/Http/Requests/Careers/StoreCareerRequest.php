<?php

namespace App\Http\Requests\Careers;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|numeric',
            'career_id'     => 'required|exists:careers,id',
            'cv'            => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter'  => 'required|string',
        ];
    }
}
