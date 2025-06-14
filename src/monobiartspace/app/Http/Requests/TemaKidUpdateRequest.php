<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemaKidUpdateRequest extends FormRequest
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
            'deskripsi'  => 'required|string',
            'waktu' => ['required', 'date_format:Y-m', 'after_or_equal:' . now()->format('Y-m')],
            'kid_id'    => ['required',  Rule::unique('tema_kids')->ignore($this->kidsTema->id)->where(function ($query) {
                return $query->where('waktu', $this->input('waktu') . '-01')->whereNull('deleted_at');
            }),],
            'week' => 'required|array|min:1|max:4',
            'week.*' => 'required|string',
            'is_active' => ['nullable', 'in:on'],
            'foto' => 'required|array|max:5',
            'foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal terdiri dari 100 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'waktu.required' => 'Waktu wajib diisi.',
            'waktu.date_format' => 'Format waktu harus dalam format Tahun-Bulan (contoh: 2025-05).',
            'waktu.after_or_equal' => 'Waktu tidak boleh lebih kecil dari bulan saat ini.',

            'kid_id.required' => 'Kelas harus dipilih',
            'kid_id.unique' => 'Tema untuk kelas dan bulan ini sudah ada',

            'week.required' => 'Data week wajib diisi.',
            'week.array' => 'Week harus berupa array.',
            'week.min' => 'Minimal harus ada 1 week.',
            'week.max' => 'Maksimal hanya boleh 4 week.',

            'week.*.required' => 'Setiap week wajib diisi.',
            'week.*.string' => 'Setiap week harus berupa teks.',
            'foto.required' => 'Mohon unggah minimal satu gambar.',
            'foto.array'    => 'Format file tidak valid.',
            'foto.max'      => 'Maksimal hanya boleh mengunggah :max gambar.',

            'foto.*.image'  => 'Setiap file harus berupa gambar.',
            'foto.*.mimes'  => 'Gambar harus berformat jpg, jpeg, atau png.',
            'foto.*.max'    => 'Ukuran setiap gambar maksimal 2MB.',
        ];
    }
}
