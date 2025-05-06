<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JadwalKidUpdateRequest extends FormRequest
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
            'kid_id' => ['required', 'exists:kids,id', Rule::unique('jadwal_kids')->where(function ($query) {
                return $query->where('hari', $this->input('hari'))
                    ->where('mulai', $this->input('mulai'))
                    ->where('akhir', $this->input('akhir'));
            })->ignore($this->route('jadwalKid'))],
            'hari'   => 'required|string|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'mulai'  => 'required|date_format:H:i',
            'akhir'  => 'required|date_format:H:i|after:mulai',
        ];
    }

    public function messages()
    {
        return  [
            'kid_id.required' => 'Kelas wajib dipilih.',
            'kid_id.exists'   => 'Kelas yang dipilih tidak valid.',
            'kid_id.unique'   => 'Jadwal dengan hari dan jam pada kelas ini telah terdaftar',

            'hari.required'   => 'Hari wajib diisi.',
            'hari.string'     => 'Hari harus berupa teks.',
            'hari.in'         => 'Hari harus berupa nama hari yang valid (senin sampai minggu).',

            'mulai.required'      => 'Waktu mulai wajib diisi.',
            'mulai.date_format'   => 'Format waktu mulai harus jam:menit (contoh: 08:00).',

            'akhir.required'      => 'Waktu akhir wajib diisi.',
            'akhir.date_format'   => 'Format waktu akhir harus jam:menit (contoh: 09:00).',
            'akhir.after'         => 'Waktu akhir harus lebih besar dari waktu mulai.',
        ];
    }
}
