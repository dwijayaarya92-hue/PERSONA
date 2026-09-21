<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    /**
     * Menampilkan semua data pegawai
     */
    public function index()
    {
        $pegawai = Pegawai::with('user')->get();

        return view('pegawai.index', compact('pegawai'));
    }


    /**
     * Menampilkan form tambah pegawai
     */
    public function create()
    {
        $bagians = Bagian::all();

        return view('pegawai.create', compact('bagians'));
    }


    /**
     * Menyimpan data pegawai baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai'  => 'required|string|max:255',
            'bagian_id'     => 'required|exists:bagians,id',
            'email'         => 'required|email|unique:users,email',
            'foto'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nik'           => 'required|numeric|unique:pegawais,nik',
            'alamat'        => 'required|string',
            'umur'          => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ], [
            'nama_pegawai.required'  => 'Nama pegawai harus diisi.',
            'email.required'         => 'Email harus diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah terdaftar.',
            'foto.required'          => 'Foto harus diisi.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.mimes'             => 'Format foto harus jpeg, png, atau jpg.',
            'foto.max'               => 'Ukuran foto maksimal 2 MB.',
            'nik.required'           => 'NIK harus diisi.',
            'nik.numeric'            => 'NIK harus berupa angka.',
            'nik.unique'             => 'NIK sudah terdaftar.',
            'alamat.required'        => 'Alamat harus diisi.',
            'umur.required'          => 'Umur harus diisi.',
            'umur.numeric'           => 'Umur harus berupa angka.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date'     => 'Tanggal lahir tidak valid.',
            'tempat_lahir.required'  => 'Tempat lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
        ]);


        // =========================
        // UPLOAD FOTO
        // =========================

        $foto = $request->file('foto');

        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();

        Storage::disk('public')->putFileAs(
            'foto_pegawai',
            $foto,
            $fileName
        );


        // =========================
        // SIMPAN DATA PEGAWAI
        // =========================

        $data = $request->except(['foto', 'email']);

        $data['foto'] = $fileName;

        $pegawai = Pegawai::create($data);


        // =========================
        // BUAT AKUN USER
        // =========================

        $user = User::create([
            'name'       => $request->nama_pegawai,
            'email'      => $request->email,
            'password'   => Hash::make('password'),
            'pegawai_id' => $pegawai->id,
        ]);


        // =========================
        // HUBUNGKAN PEGAWAI DENGAN USER
        // =========================

        if (isset($pegawai->user_id)) {
            $pegawai->user_id = $user->id;
            $pegawai->save();
        }


        Alert::success(
            'Berhasil',
            'Data pegawai berhasil ditambahkan.'
        );

        return redirect()->route('pegawai.index');
    }


    /**
     * Menampilkan form edit pegawai
     */
    public function edit(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $bagians = Bagian::all();

        return view(
            'pegawai.edit',
            compact('pegawai', 'bagians')
        );
    }


    /**
     * Memperbarui data pegawai
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama_pegawai'  => 'required|string|max:255',
            'bagian_id'     => 'required|exists:bagians,id',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nik'           => 'required|numeric|unique:pegawais,nik,' . $pegawai->id,
            'alamat'        => 'required|string',
            'umur'          => 'required|numeric',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ], [
            'nama_pegawai.required'  => 'Nama pegawai harus diisi.',
            'nik.required'           => 'NIK harus diisi.',
            'nik.numeric'            => 'NIK harus berupa angka.',
            'nik.unique'             => 'NIK sudah terdaftar.',
            'alamat.required'        => 'Alamat harus diisi.',
            'umur.required'          => 'Umur harus diisi.',
            'umur.numeric'           => 'Umur harus berupa angka.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date'     => 'Tanggal lahir tidak valid.',
            'tempat_lahir.required'  => 'Tempat lahir harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.mimes'             => 'Format foto harus jpeg, png, atau jpg.',
            'foto.max'               => 'Ukuran foto maksimal 2 MB.',
        ]);


        // =========================
        // DATA PEGAWAI
        // =========================

        $data = $request->except([
            'foto',
            'email'
        ]);


        // =========================
        // FOTO BARU
        // =========================

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $pegawai->foto &&
                Storage::disk('public')->exists(
                    'foto_pegawai/' . $pegawai->foto
                )
            ) {
                Storage::disk('public')->delete(
                    'foto_pegawai/' . $pegawai->foto
                );
            }


            // Upload foto baru
            $foto = $request->file('foto');

            $fileName = Str::uuid() . '.' .
                $foto->getClientOriginalExtension();

            Storage::disk('public')->putFileAs(
                'foto_pegawai',
                $foto,
                $fileName
            );

            $data['foto'] = $fileName;

        } else {

            // Pertahankan foto lama
            $data['foto'] = $pegawai->foto;
        }


        // =========================
        // UPDATE PEGAWAI
        // =========================

        $pegawai->update($data);


        // =========================
        // UPDATE USER
        // =========================

        if ($pegawai->user) {

            $pegawai->user->update([
                'name' => $request->nama_pegawai,
            ]);
        }


        Alert::success(
            'Berhasil',
            'Data pegawai berhasil diperbarui.'
        );

        return redirect()->route('pegawai.index');
    }


    /**
     * Menampilkan detail pegawai
     */
    public function show(string $id)
    {
        $pegawai = Pegawai::with([
            'user',
            'bagian'
        ])->findOrFail($id);

        return view(
            'pegawai.show',
            compact('pegawai')
        );
    }


    /**
     * Menghapus data pegawai
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);


        // Hapus foto
        if (
            $pegawai->foto &&
            Storage::disk('public')->exists(
                'foto_pegawai/' . $pegawai->foto
            )
        ) {
            Storage::disk('public')->delete(
                'foto_pegawai/' . $pegawai->foto
            );
        }


        // Lepaskan hubungan dengan user
        User::where('pegawai_id', $pegawai->id)
            ->update([
                'pegawai_id' => null
            ]);


        // Hapus pegawai
        $pegawai->delete();


        Alert::success(
            'Berhasil',
            'Data pegawai berhasil dihapus.'
        );

        return redirect()->route('pegawai.index');
    }
}