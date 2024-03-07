<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            // Jika login berhasil, catat aktivitas login dengan detail pengguna
            activity()
                ->causedBy(Auth::user())
                ->log('Logged in successfully');

            return redirect('staff');
        } else {
            // Jika login gagal, berikan pesan kesalahan yang lebih spesifik
            return back()->with('error', 'Email atau password yang Anda masukkan salah.');
        }
    }

    function logout()
    {
        // Catat aktivitas logout dengan detail pengguna
        activity()
            ->causedBy(Auth::user())
            ->log('Logged out');

        Auth::logout();
        return redirect('/home');
    }
}
