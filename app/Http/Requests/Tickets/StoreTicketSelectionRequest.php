<?php

namespace App\Http\Requests\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketSelectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id'   => ['required', 'array', 'min:1'],
            'ticket_id.*' => ['required', 'integer', 'exists:visit_tickets,id'],
            'quantity'    => ['required', 'array', 'min:1'],
            'quantity.*'  => ['required', 'integer', 'min:1'],
            'visit_date'  => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_id.required'   => 'At least one ticket must be selected.',
            'ticket_id.*.exists'   => 'Selected ticket does not exist.',
            'quantity.*.min'       => 'Quantity must be at least 1.',
            'visit_date.after_or_equal'=> 'Visit date must be today or later.',
        ];
    }
}
