<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
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
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'jk' => ['required', Rule::in(['l', 'p'])],
            'notelp' => [
                'required',
                'regex:/^\+62[0-9]{9,15}$/',
                'max:15'
            ],
            'alamat' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                'email:rfc,dns'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',
            'jk.required' => 'Jenis kelamin wajib diisi.',
            'jk.in' => 'Jenis kelamin harus salah satu dari: Laki-laki atau Perempuan.',
            'notelp.required' => 'Nomor telepon wajib diisi.',
            'notelp.regex' => 'Nomor telepon harus diawali dengan +62 dan diikuti 9-13 digit angka.',
            'notelp.max' => 'Nomor telepon maksimal 15 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.max' => 'Username maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.lowercase' => 'Email harus menggunakan huruf kecil.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Email maksimal 255 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 64 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ];
    }
}
