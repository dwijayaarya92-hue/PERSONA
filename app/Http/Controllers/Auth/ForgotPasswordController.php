<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan halaman lupa password.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Mengubah password secara langsung.
     */
    public function resetDirect(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                    'exists:users,email',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ],
            [
                'email.required' => 'Email harus diisi.',

                'email.email' => 'Format email tidak valid.',

                'email.exists' => 'Email tidak terdaftar.',

                'password.required' => 'Password baru harus diisi.',

                'password.min' => 'Password baru minimal 8 karakter.',

                'password.confirmed' =>
                    'Konfirmasi password tidak cocok.',
            ]
        );

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Pengaman tambahan
        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar.');
        }

        // Simpan password baru
        $user->password = Hash::make($request->password);
        $user->save();

        // Kembali ke halaman login
        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password berhasil diubah. Silakan login menggunakan password baru.'
            );
    }
}