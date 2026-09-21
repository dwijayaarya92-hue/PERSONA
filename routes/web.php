<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// =====================================================
// HALAMAN AWAL
// =====================================================

Route::get('/', function () {
    return view('auth.login');
});


// =====================================================
// AUTHENTICATION
// Login, Register, Logout
// Reset password bawaan Laravel dinonaktifkan
// =====================================================

Auth::routes([
    'reset' => false,
]);


// =====================================================
// LUPA PASSWORD
// =====================================================

// Menampilkan halaman lupa password
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Memproses perubahan password secara langsung
Route::post('/password/reset-direct', [ForgotPasswordController::class, 'resetDirect'])
    ->name('password.reset.direct');


// =====================================================
// DASHBOARD
// =====================================================

Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');


// =====================================================
// PROFILE
// =====================================================

Route::middleware('auth')->group(function () {

    // Menampilkan halaman edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Menyimpan perubahan profile
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
});


// =====================================================
// TEST QUERY
// =====================================================

Route::get('/coba_query', function () {

    $pegawai = Pegawai::all();

    dd($pegawai->toArray());

})->middleware('auth');


// =====================================================
// DATA PEGAWAI
// =====================================================

Route::resource('pegawai', PegawaiController::class)
    ->middleware('auth');

// Download foto pegawai
Route::get('/download-foto/{id}', [PegawaiController::class, 'downloadFoto'])
    ->name('download-foto')
    ->middleware('auth');


// =====================================================
// DATA USERS
// Hanya Admin dan Supervisor
// =====================================================

Route::resource('users', UserController::class)
    ->middleware([
        'auth',
        'isSupervisor',
    ]);

// Mengubah role user
Route::post('/user-update-role', [UserController::class, 'updateRole'])
    ->name('users.update-roles')
    ->middleware([
        'auth',
        'isSupervisor',
    ]);


// =====================================================
// DATA BAGIAN
// =====================================================

Route::resource('bagian', BagianController::class)
    ->middleware('auth');


// =====================================================
// FALLBACK / 404
// =====================================================

Route::fallback(function () {
    return view('404');
});