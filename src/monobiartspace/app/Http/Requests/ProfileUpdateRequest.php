<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],

            'username' => [
                'required',
                'alpha_num',
                'min:4',
                'max:30',
                Rule::unique('users', 'name')->ignore($this->user()->id),
            ],

            'jk' => ['required', Rule::in(['l', 'p'])],

            'alamat' => ['nullable', 'string', 'max:255'],

            'notelp' => [
                'nullable',
                'regex:/^\+62[0-9]{9,15}$/',
                'max:15'
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email:rfc,dns',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_num' => 'Username hanya boleh terdiri dari huruf dan angka.',
            'username.min' => 'Username minimal harus :min karakter.',
            'username.max' => 'Username maksimal :max karakter.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'jk.in' => 'Jenis kelamin hanya boleh L (Laki-laki) atau P (Perempuan).',
            'alamat.max' => 'Alamat terlalu panjang, maksimal :max karakter.',
            'notelp.regex' => 'Nomor telepon harus valid dan sesuai format Indonesia +62812xxxx).',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar',
        ];
    }
}
