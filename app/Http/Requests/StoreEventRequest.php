<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'category' => 'required|in:konser,workshop',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'location' => 'required|min:3|max:255',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'title.required' => 'Judul acara wajib diisi.',
            'title.min' => 'Judul acara minimal 3 karakter.',
            'title.max' => 'Judul acara maksimal 255 karakter.',
            'description.required' => 'Deskripsi acara wajib diisi.',
            'description.min' => 'Deskripsi acara minimal 3 karakter.',
            'category.required' => 'Kategori acara wajib diisi.',
            'category.in' => 'Kategori acara harus salah satu dari: konser, workshop.',
            'date.required' => 'Tanggal acara wajib diisi.',
            'date.date_format' => 'Tanggal acara harus dalam format: YYYY-MM-DD (contoh: 2026-06-09).',
            'time.required' => 'Waktu acara wajib diisi.',
            'time.date_format' => 'Waktu acara harus dalam format: HH:MM (contoh: 08:00).',
            'location.required' => 'Lokasi acara wajib diisi.',
            'location.min' => 'Lokasi acara minimal 3 karakter.',
            'location.max' => 'Lokasi acara maksimal 255 karakter.',
        ];
    }
}
