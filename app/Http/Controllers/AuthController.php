<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login'); // Pastikan file ada di resources/views/auth/login.blade.php
    }

    // Memproses data login
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        // 'remember' diambil dari checkbox di form
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Jika berhasil, buat ulang session
            $request->session()->regenerate();

            // Arahkan ke dashboard
            return redirect()->intended('dashboard');
        }

        // 3. Jika gagal, kembalikan ke login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/log-in');
    }
}