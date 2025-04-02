<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'shop_item_id' => 'required|exists:shop_items,id',
            'review' => 'required|string|min:5|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }
}
