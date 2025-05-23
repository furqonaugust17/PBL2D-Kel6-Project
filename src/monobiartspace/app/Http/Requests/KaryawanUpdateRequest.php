<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KaryawanUpdateRequest extends FormRequest
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
        $user_id = $this->route('karyawan')->user_id;

        return [
            'nama' => ['required', 'string', 'max:100'],

            'username' => [
                'required',
                'alpha_num',
                'min:4',
                'max:30',
                Rule::unique('users', 'name')->ignore($user_id),
            ],

            'jk' => ['required', Rule::in(['l', 'p'])],

            'alamat' => ['nullable', 'string', 'max:255'],

            'notelp' => [
                'nullable',
                'regex:/^(\+62|0)[0-9]{9,15}$/',
                'max:15'
            ],

            'email' => [
                'nullable',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore($user_id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
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
            'notelp.regex' => 'Nomor telepon harus valid dan sesuai format Indonesia (cth: 0812xxxx atau +62812xxxx).',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.max' => 'Password maksimal :max karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ];
    }
}
