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
            'event_id' => 'sometimes|integer',
            'price' => 'sometimes|integer|min:5',
            'quota' => 'sometimes|integer',
            'remaining_quota' => 'sometimes|integer',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'event_id.integer' => 'Id acara harus integer',
            'price.integer' => 'Harga harus integer',
            'price.min' => 'Harga minimal 5 karakter (contoh: 10000)',
            'quota.integer' => 'Kuota harus integer',
            'remaining_quota.integer' => 'Sisa kuota harus integer',
        ];
    }
}
