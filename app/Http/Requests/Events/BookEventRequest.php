<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class BookEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'selected_categories' => 'required|array',
            'quantities' => 'required|array',
        ];
    }
}
