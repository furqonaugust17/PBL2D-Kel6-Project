<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanArtSpaceUpdateRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'artspace_id'  => 'required',
            'harga' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kegiatan wajib diisi.',
            'nama.string' => 'Nama kegiatan harus berupa teks.',
            'nama.max' => 'Nama kegiatan maksimal :max karakter.',

            'artspace_id.required' => 'Kelas harus dipilih.',

            'harga.required' => 'Harga kegiatan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
