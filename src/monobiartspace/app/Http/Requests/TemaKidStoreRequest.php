<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemaKidStoreRequest extends FormRequest
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
            'nama'  => 'required|string|max:100',
            'kid_id'    => ['required',  Rule::unique('tema_kids')->where(function ($query) {
                return $query->where('waktu', $this->input('waktu') . '-01');
            }),],
            'waktu' => ['required', 'date_format:Y-m', 'after_or_equal:' . now()->format('Y-m')],
            'week' => 'required|array|min:1|max:4',
            'week.*' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 100 karakter.',

            'waktu.required' => 'Waktu wajib diisi.',
            'waktu.date_format' => 'Format waktu harus dalam bentuk Tahun-Bulan (contoh: 2025-05).',
            'waktu.after_or_equal' => 'Waktu tidak boleh kurang dari bulan sekarang.',
            'waktu.unique'  => 'Waktu ini telah terdaftar pada kelas yang dipilih',

            'kid_id.required' => 'Kelas harus dipilih',
            'kid_id.unique' => 'Tema untuk kelas dan bulan ini sudah ada',

            'week.required' => 'Minimal satu data week harus diisi.',
            'week.array' => 'Data week harus berupa array.',
            'week.min' => 'Minimal harus ada 1 item week.',
            'week.max' => 'Maksimal hanya 4 item week yang diperbolehkan.',

            'week.*.string' => 'Setiap item pada week harus berupa teks.',
        ];
    }
}
