<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalArtSpaceUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sesi' => 'required|string|max:10',
            'mulai'     => 'required|date_format:H:i',
            'akhir'     => 'required|date_format:H:i|after:mulai',
            'kapasitas'     => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'sesi.required' => 'Nama sesi wajib diisi.',
            'sesi.string'   => 'Nama sesi harus berupa teks.',
            'sesi.max'      => 'Nama sesi maksimal 10 karakter.',

            'mulai.required'     => 'Waktu mulai wajib diisi.',
            'mulai.date_format'  => 'Format waktu mulai tidak valid. Gunakan format jam:menit (contoh: 08:00).',

            'akhir.required'     => 'Waktu akhir wajib diisi.',
            'akhir.date_format'  => 'Format waktu akhir tidak valid. Gunakan format jam:menit (contoh: 09:00).',
            'akhir.after'        => 'Waktu akhir harus lebih dari waktu mulai.',

            'kapasitas.required'     => 'Kapasitas wajib diisi',
            'kapasitas.integer'     => 'Kapasitas harus dalam bentuk angka',
            'kapasitas.min'     => 'Kapasitas minimal 1',
        ];
    }
}
