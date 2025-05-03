<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtSpaceStoreRequest extends FormRequest
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
            'nama'  => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kelas harus diisi',
            'nama.string' => 'Nama kelas harus dalam bentuk huruf',
            'nama.max' => 'Nama kelas maksimal 100 karakter',
        ];
    }
}
