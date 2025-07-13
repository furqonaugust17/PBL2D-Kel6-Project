<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtSpaceBookingRequest extends FormRequest
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
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'sesi' => ['required', 'exists:jadwal_art_spaces,id'],
            'participants' => ['required', 'array', 'min:1'],

            'participants.*.name' => [
                'required',
                'string',
            ],

            'participants.*.activity_id' => [
                'required',
                'integer',
                'exists:kegiatan_art_spaces,id',
            ],
            'diskon'    => 'nullable|exists:diskons,code'
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal.after_or_equal' => 'Tanggal harus hari ini atau setelahnya.',
            'sesi.exists' => 'Sesi yang dipilih tidak tersedia.',
            'participants.required' => 'Peserta harus diisi.',
            'participants.array' => 'Format peserta tidak valid.',
            'participants.min' => 'Minimal harus ada satu peserta.',

            'participants.*.name.required' => 'Nama peserta wajib diisi.',

            'participants.*.activity_id.required' => 'Activity ID peserta wajib diisi.',
            'participants.*.activity_id.integer' => 'Activity ID harus berupa angka.',
            'participants.*.activity_id.exists' => 'Activity ID tidak ditemukan di database.',
            'diskon.exists' => 'Kode diskon tidak ada'
        ];
    }
}
