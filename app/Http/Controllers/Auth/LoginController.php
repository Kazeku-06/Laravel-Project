<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Tampilkan form login
    public function index()
    {
        return view('pages.auth.login');
    }

    // Proses login
    public function action(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba ambil user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Validasi user dan password
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            // Redirect sesuai role
            if ($user->isadmin) {
                return redirect()->route('admin.dashboard'); // route untuk admin
            } else {
                return redirect()->route('user.home'); // route untuk user biasa
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
