<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shop_item_id' => 'required|exists:shop_items,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
