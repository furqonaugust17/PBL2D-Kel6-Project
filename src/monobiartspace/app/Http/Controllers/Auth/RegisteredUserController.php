<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->request);

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'jk' => ['required', Rule::in(['l', 'p'])],
            'notelp' => [
                'required',
                'regex:/^(\+62|0)[0-9]{9,15}$/',
                'max:15'
            ],
            'alamat' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, 'email:rfc,dns'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $customer = Customer::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'jk'    => $request->jk,
            'notelp'    => $request->notelp,
            'alamat'    => $request->alamat,
            'user_id'   => $user->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
