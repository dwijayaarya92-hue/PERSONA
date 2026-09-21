<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  public function index() 
{
    $users = User::with('role')->get(); // Wajib pakai with('role')
    $roles = Role::all();
    
    return view('users.index', compact('users', 'roles'));
}

public function updateRole(Request $request)
{
    $request->validate([
        'role' => 'required', // Validasi input dari select modal
        'user_id' => 'required',
    ]);

    $userId = $request->user_id;
    $selectedRole = $request->role; // Nilai string dari select (misal: "admin", "supervisor", dll)

    $user = User::find($userId);
    $user->role = $selectedRole; // Simpan langsung ke kolom string 'role'
    $user->save();

    Alert::success('Berhasil', 'Role berhasil diubah');
    return redirect()->route('users.index');
}
}