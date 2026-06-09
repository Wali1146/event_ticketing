<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreTicketRequest extends FormRequest
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
            'event_id' => 'required|integer',
            'price' => 'required|integer|min:5',
            'quota' => 'required|integer',
            'remaining_quota' => 'required|integer',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'event_id.required' => 'Id acara harus diisi',
            'event_id.integer' => 'Id acara harus integer',
            'price.required' => 'Harga harus diisi',
            'price.integer' => 'Harga harus integer',
            'price.min' => 'Harga minimal 5 karakter (contoh: 10000)',
            'quota.required' => 'Kuota harus diisi',
            'quota.integer' => 'Kuota harus integer',
            'remaining_quota.required' => 'Sisa kuota harus diisi',
            'remaining_quota.integer' => 'Sisa kuota harus integer',
        ];
    }
}
