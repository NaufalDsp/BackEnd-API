<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    // Proses autentikasi login
    public function authenticate(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Berhasil login
            Alert::success('Success', 'Login success!');
            return redirect()->intended('/dashboard');
        } else {
            // Gagal login
            Alert::error('Error', 'Login failed! Please check your credentials.');
            return redirect('/login');
        }
    }

    // Tampilkan halaman registrasi
    public function register()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    // Proses penyimpanan data registrasi
    public function process(Request $request)
    {
        // Validasi data registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|same:password', // Konfirmasi password
        ]);

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Simpan data user ke database
        User::create($validated);

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'Registration successful! Please login.');

        // Redirect ke halaman login
        return redirect('/login');
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus sesi pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tampilkan notifikasi logout sukses
        Alert::success('Success', 'Log out success!');

        // Redirect ke halaman login
        return redirect('/login');
    }
}
