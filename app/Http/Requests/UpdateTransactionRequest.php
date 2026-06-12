<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateTransactionRequest extends FormRequest
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
            'user_id' => 'sometimes|integer',
            'ticket_id' => 'sometimes|integer',
            'qty' => 'sometimes|integer',
            'total_price' => 'sometimes|integer|min:5',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'user_id.integer' => 'Id pengguna harus integer',
            'ticket_id.integer' => 'Id tiket harus integer',
            'qty.integer' => 'Jumlah harus integer',
            'total_price.integer' => 'Harga total harus integer',
            'total_price.min' => 'Harga total minimal 5 karakter (contoh: 10000)',
        ];
    }
}
