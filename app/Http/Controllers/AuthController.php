<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // LOGIN: tampil form
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // LOGIN: proses
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('fasilitas.index'))
                ->with('success', 'Berhasil login. Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    // REGISTRASI: tampil form
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // REGISTRASI: simpan user baru
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // password otomatis di-hash oleh cast 'hashed' di model User
        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Registrasi berhasil. Selamat datang, ' . $user->name . '!');
    }

    // LOGOUT
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kamu sudah logout.');
    }
}