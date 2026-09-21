<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Bagian;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah seluruh pegawai
        $totalPegawai = Pegawai::count();

        // Mengambil jumlah seluruh bagian
        $totalBagian = Bagian::count();

        // Mengambil akun yang sedang login
        $user = Auth::user();

        // Mengirim data ke halaman home
        return view('home', compact(
            'totalPegawai',
            'totalBagian',
            'user'
        ));
    }
}