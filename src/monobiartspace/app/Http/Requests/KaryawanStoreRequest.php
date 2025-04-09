<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KaryawanStoreRequest extends FormRequest
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
            'email'    => ['required', 'string', Rule::unique('users', 'email')],
            'password'  => 'required'
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
