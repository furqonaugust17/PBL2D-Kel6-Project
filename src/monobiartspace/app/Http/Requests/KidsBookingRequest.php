<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KidsBookingRequest extends FormRequest
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
            'nama_lengkap' => ['required', 'string', 'min:3'],
            'nama_panggilan' => ['required', 'string', 'min:2'],
            'usia_saat_ini' => ['required', 'integer', 'min:1', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'kelas' => ['required', 'exists:kids,id'],
            'kategori' => ['required', 'exists:kategori_kids,id'],
            'jadwal' => ['required', 'exists:jadwal_kids,id'],
            'tema' => ['required', 'array', 'min:1'],
            'tema.*' => ['exists:detail_tema_kids,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_panggilan.required' => 'Nama panggilan wajib diisi.',
            'usia_saat_ini.required' => 'Usia wajib diisi.',
            'usia_saat_ini.min' => 'Usia minimal 1 tahun.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh di masa depan.',
            'kelas.exists' => 'Kelas tidak valid.',
            'kategori.exists' => 'Kategori tidak valid.',
            'jadwal.exists' => 'Jadwal tidak valid.',
            'tema.required' => 'Tema wajib diisi.',
            'tema.array' => 'Format tema harus berupa array.',
            'tema.*.exists' => 'Tema yang dipilih tidak ditemukan.',
        ];
    }
}
