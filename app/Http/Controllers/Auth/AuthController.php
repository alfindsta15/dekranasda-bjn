<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // GET /admin/login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    // POST /admin/login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // cek user ada dan role admin
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || ($user->role ?? User::ROLE_USER) !== User::ROLE_ADMIN) {
            return back()->withErrors([
                'email' => 'Email/Password salah atau akun Anda bukan admin.',
            ])->onlyInput('email');
        }

        // attempt & remember
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email/Password salah.',
        ])->onlyInput('email');
    }

    // POST /admin/logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
