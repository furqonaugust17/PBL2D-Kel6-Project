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
        return [
            'nama' => 'required|string|max:50',
            'username' => 'required|string',
            'jk'   => 'required|string',
            'alamat'    => 'required|string',
            'notelp'    => 'required|max:15',
            'email'    => ['required', 'string', 'email:rfc,dns', Rule::unique('users', 'email')],
            'password'  => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'nama harus dalam bentuk kalimat',
            'nama.max' => 'nama maksimal 50 karakter',
            'username.required' => 'username tidak boleh kosong',
            'username.string' => 'username harus dalam bentuk kalimat',
            'jk.required' => 'jenis kelamin harus dipilih',
            'jk.string' => 'jenis kelamin harus dalam bentuk kalimat',
            'notelp.required' => 'nomor telepon tidak boleh kosong',
            'notelp.max' => 'nomor telepon maksimal 15 karakter',
            'email.required' => 'email tidak boleh kosong',
            'email.string' => 'email harus dalam bentuk kalimat',
            'email.email' => 'email tidak valid',
            'email.unique' => 'email telah digunakan',
            'password.required' => 'password tidak boleh kosong',
        ];
    }
}
