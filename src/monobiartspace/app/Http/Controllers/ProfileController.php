<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view($request->user()->getRoleNames()->first() != 'customer' ? 'profile.edit' : 'profile.customer', [
            'user' => $request->user(),
            'title' => 'Profile',
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->name = $data['username'];
        $request->user()->email = $data['email'];

        if ($request->user()->getRoleNames()->first() != 'customer') {
            $request->user()->karyawan->update([
                'nama' => $data['nama'],
                'jk' => $data['jk'],
                'alamat' => $data['alamat'],
                'notelp' => $data['notelp'],
            ]);
        } else {
            $request->user()->customer->update([
                'nama_lengkap' => $data['nama'],
                'notelp' => $data['notelp'],
                'alamat' => $data['alamat'],
                'jk' => $data['jk'],
            ]);
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile berhasil diperbarui');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($request->user()->getRoleNames()->first() != 'customer') {
            $request->user()->karyawan->delete();
        } else {
            $request->user()->customer->delete();
        }
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
