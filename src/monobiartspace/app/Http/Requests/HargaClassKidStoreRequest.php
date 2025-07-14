<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HargaClassKidStoreRequest extends FormRequest
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
            'kid_id' => 'required|exists:kids,id',
            'harga' => 'required|numeric|min:0',
            'jumlah_pertemuan' => ['required', 'integer', 'min:1', Rule::unique('harga_class_kids')->where(function ($query) {
                return $query->where('kid_id', $this->input('kid_id'));
            })],
            'deskripsi' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'kid_id.required' => 'Kid harus dipilih.',
            'kid_id.exists' => 'Kid yang dipilih tidak ditemukan.',

            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',

            'jumlah_pertemuan.required' => 'Jumlah pertemuan harus diisi.',
            'jumlah_pertemuan.integer' => 'Jumlah pertemuan harus berupa angka.',
            'jumlah_pertemuan.min' => 'Jumlah pertemuan minimal 1.',
            'jumlah_pertemuan.unique' => 'Jumlah pertemuan dengan harga tersebut sudah terdaftar',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
