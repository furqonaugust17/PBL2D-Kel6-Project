<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ], [
            'current_password.required' => 'password sekarang wajib diisi',
            'current_password.current_password' => 'password sekarang salah',
            'password.required' => 'password wajib diisi.',
            'password.confirmed' => 'konfirmasi password tidak cocok.',
            'password.min' => 'password minimal harus terdiri dari 8 karakter.',
            'password.max' => 'password tidak boleh lebih dari 64 karakter.',
            'password.regex' => 'password harus mengandung huruf besar, huruf kecil, angka, dan simbol (@$!%*?&).',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password berhasil diperbarui');
    }
}
