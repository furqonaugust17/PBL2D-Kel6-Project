<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiskonStoreRequest extends FormRequest
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
            'diskon' => 'required|numeric|min:1|max:100',
            'code' => 'required|string|unique:diskons,code|max:30',
            'expired_date' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'nama diskon tidak boleh kosong',
            'nama.string' => 'nama diskon harus berupa kalimat',
            'nama.max' => 'nama diskon maksimal 50 karakter',

            'diskon.required' => 'jumlah diskon tidak boleh kosong',
            'diskon.numeric' => 'jumlah diskon harus berupa angka',
            'diskon.min' => 'jumlah diskon minimal 1%',
            'diskon.max' => 'jumlah diskon maksimal 100%',

            'code.required' => 'kode diskon tidak boleh kosong',
            'code.string' => 'kode diskon harus berupa kalimat',
            'code.unique' => 'kode diskon ini sudah terdaftar',
            'code.max' => 'kode diskon maksimal 30 karakter',

            'expired_date.required' => 'tanggal kadaluarsa tidak boleh kosong',
            'expired_date.date' => 'tanggal kadaluarsa harus berupa tanggal',
            'expired_date.after' => 'tanggal kadaluarsa harus setelah hari ini',
        ];
    }
}
