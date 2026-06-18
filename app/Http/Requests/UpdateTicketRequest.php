<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'sometimes|integer|exists:event,id',
            'price' => 'sometimes|integer|min:10000',
            'quota' => 'sometimes|integer|min:1',
            'remaining_quota' => 'sometimes|integer|min:0',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'event_id.integer' => 'Id acara harus integer',
            'event_id.exists' => 'Id acara tidak ditemukan',
            'price.integer' => 'Harga harus integer',
            'price.min' => 'Harga minimal 10000',
            'quota.integer' => 'Kuota harus integer',
            'quota.min' => 'Kuota minimal 1',
            'remaining_quota.integer' => 'Sisa kuota harus integer',
            'remaining_quota.min' => 'Sisa kuota minimal 0',
        ];
    }
}
