<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureUserIsAdmin
{
    /**
     * Pastikan hanya user dengan role 'admin' yang boleh lanjut.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = Auth::user();

        // Jika belum login atau role bukan admin -> lempar ke beranda (atau abort(403))
        if (!$user || ($user->role ?? User::ROLE_USER) !== User::ROLE_ADMIN) {
            return redirect()->route('home');
            // Alternatif:
            // abort(403);
        }

        return $next($request);
    }
}
