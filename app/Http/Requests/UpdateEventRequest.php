<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateEventRequest extends FormRequest
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
            'title' => 'sometimes|min:3|max:255',
            'description' => 'sometimes|min:3',
            'category' => 'sometimes|in:konser,workshop',
            'date' => 'sometimes|date_format:d F Y',
            'time' => 'sometimes|date_format:H:i',
            'location' => 'sometimes|min:3|max:255',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'title.min' => 'Judul acara minimal 3 karakter.',
            'title.max' => 'Judul acara maksimal 255 karakter.',
            'description.min' => 'Deskripsi acara minimal 3 karakter.',
            'category.in' => 'Kategori acara harus salah satu dari: konser, workshop.',
            'date.date_format' => 'Tanggal acara harus dalam format: d F Y (contoh: 25 December 2024).',
            'time.date_format' => 'Waktu acara harus dalam format: H:i (contoh: 19:30).',
            'location.min' => 'Lokasi acara minimal 3 karakter.',
            'location.max' => 'Lokasi acara maksimal 255 karakter.',
        ];
    }
}
