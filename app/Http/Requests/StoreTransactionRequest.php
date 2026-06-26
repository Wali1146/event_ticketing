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
            'user_id' => 'integer',
            'ticket_id' => 'required|integer|exists:tickets,id',
            'qty' => 'required|integer|min:1',
            'total_price' => 'integer|min:10000',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'user_id.integer' => 'Id pengguna harus integer',
            'ticket_id.required' => 'Id tiket harus diisi',
            'ticket_id.integer' => 'Id tiket harus integer',
            'ticket_id.exists' => 'Id tiket tidak ditemukan',
            'qty.required' => 'Jumlah harus diisi',
            'qty.integer' => 'Jumlah harus integer',
            'qty.min' => 'Jumlah minimal 1',
            'total_price.required' => 'Harga total harus diisi',
            'total_price.integer' => 'Harga total harus integer',
            'total_price.min' => 'Harga total minimal 10000',
        ];
    }
}
