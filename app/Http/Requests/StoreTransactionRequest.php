<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreTransactionRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'ticket_id' => 'required|integer',
            'qty' => 'required|integer',
            'total_price' => 'required|integer|min:5',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'user_id.required' => 'Id pengguna harus diisi',
            'user_id.integer' => 'Id pengguna harus integer',
            'ticket_id.required' => 'Id tiket harus diisi',
            'ticket_id.integer' => 'Id tiket harus integer',
            'qty.required' => 'Jumlah harus diisi',
            'qty.integer' => 'Jumlah harus integer',
            'total_price.required' => 'Harga total harus diisi',
            'total_price.integer' => 'Harga total harus integer',
            'total_price.min' => 'Harga total minimal 5 karakter (contoh: 10000)',
        ];
    }
}
