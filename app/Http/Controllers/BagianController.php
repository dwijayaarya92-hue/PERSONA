<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BagianController extends Controller
{
    /**
     * Menampilkan semua data bagian
     * beserta jumlah karyawan di setiap bagian.
     */
    public function index()
    {
        $bagians = Bagian::withCount('pegawai')->get();

        // Konfirmasi sebelum menghapus data
        $title = 'Konfirmasi Hapus Data Bagian';
        $text = 'Data akan dihapus secara permanen, lanjutkan?';

        confirmDelete($title, $text);

        return view('bagian.index', compact('bagians'));
    }

    /**
     * Menampilkan halaman tambah bagian.
     */
    public function create()
    {
        return view('bagian.create');
    }

    /**
     * Menyimpan data bagian baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ], [
            'nama_bagian.required' => 'Nama bagian harus diisi.',
            'nama_bagian.string'   => 'Nama bagian harus berupa teks.',
            'nama_bagian.max'      => 'Nama bagian maksimal 255 karakter.',
        ]);

        Bagian::create([
            'nama_bagian' => $request->nama_bagian,
        ]);

        Alert::success(
            'Berhasil',
            'Data bagian berhasil ditambahkan.'
        );

        return redirect()->route('bagian.index');
    }

    /**
     * Menampilkan detail bagian.
     */
    public function show(Bagian $bagian)
    {
        return view('bagian.show', compact('bagian'));
    }

    /**
     * Menampilkan halaman edit bagian.
     */
    public function edit(Bagian $bagian)
    {
        return view('bagian.edit', compact('bagian'));
    }

    /**
     * Memperbarui data bagian.
     */
    public function update(Request $request, Bagian $bagian)
    {
        $request->validate([
            'nama_bagian' => 'required|string|max:255',
        ], [
            'nama_bagian.required' => 'Nama bagian harus diisi.',
            'nama_bagian.string'   => 'Nama bagian harus berupa teks.',
            'nama_bagian.max'      => 'Nama bagian maksimal 255 karakter.',
        ]);

        $bagian->update([
            'nama_bagian' => $request->nama_bagian,
        ]);

        Alert::success(
            'Berhasil',
            'Data bagian berhasil diperbarui.'
        );

        return redirect()->route('bagian.index');
    }

    /**
     * Menghapus data bagian.
     */
    public function destroy(Bagian $bagian)
    {
        $bagian->delete();

        Alert::success(
            'Berhasil',
            'Data bagian berhasil dihapus.'
        );

        return redirect()->route('bagian.index');
    }
}