<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class VerifyIsSupervisor
{
    /**
     * Menangani request yang masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        $user = $request->user();

        if (!$user) {
            Alert::error(
                'Gagal',
                'Silakan login terlebih dahulu.'
            );

            return redirect()->route('login');
        }

        // Ambil role user
        $role = strtolower(trim((string) ($user->role ?? '')));

        /*
        |--------------------------------------------------------------------------
        | Hak akses
        |--------------------------------------------------------------------------
        | Admin dan Supervisor boleh mengakses halaman Data User.
        | Staff tidak diperbolehkan.
        */

        if (in_array($role, ['admin', 'supervisor'], true)) {
            return $next($request);
        }

        // Jika role bukan Admin atau Supervisor
        Alert::error(
            'Akses Ditolak',
            'Anda tidak memiliki akses ke halaman ini.'
        );

        return redirect()->route('home');
    }
}