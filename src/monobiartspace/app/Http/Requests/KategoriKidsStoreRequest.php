<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriKidsStoreRequest extends FormRequest
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
            'nama' => 'required|string|max:50',
            'kid_id' => 'required',
            'deskripsi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.string' => 'Nama kategori harus dalam bentuk huruf',
            'nama.max' => 'Nama kategori maksimal 50 karakter',

            'kid_id.required'   => 'Kelas harus dipilih',

            'deskripsi.required'    => 'Deskripsi harus diisi'
        ];
    }
}
