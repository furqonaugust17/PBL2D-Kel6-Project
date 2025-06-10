<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanArtSpaceStoreRequest extends FormRequest
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
            'deskripsi' => 'required|string',
            'artspace_id'  => 'required',
            'harga' => 'required|numeric|min:0',
            'foto' => 'required|array|max:5',
            'foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kegiatan wajib diisi.',
            'nama.string' => 'Nama kegiatan harus berupa teks.',
            'nama.max' => 'Nama kegiatan maksimal :max karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'artspace_id.required' => 'Kelas harus dipilih.',

            'harga.required' => 'Harga kegiatan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',

            'foto.required' => 'Mohon unggah minimal satu gambar.',
            'foto.array'    => 'Format file tidak valid.',
            'foto.max'      => 'Maksimal hanya boleh mengunggah :max gambar.',

            'foto.*.image'  => 'Setiap file harus berupa gambar.',
            'foto.*.mimes'  => 'Gambar harus berformat jpg, jpeg, atau png.',
            'foto.*.max'    => 'Ukuran setiap gambar maksimal 2MB.',
        ];
    }
}
