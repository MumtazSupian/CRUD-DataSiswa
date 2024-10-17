<?php

namespace App\Http\Controllers;

use App\Models\dataSiswa; // Pastikan Anda mengimpor model dataSiswa
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        $siswa = dataSiswa::all(); // Mengambil semua data siswa dari database
        return view('siswa.index', compact('siswa')); // Mengirim data siswa ke view
    }

    // Menampilkan form pembuatan siswa
    public function create()
    {
        return view('siswa.create'); // Mengirim view untuk form pembuatan siswa
    }

    // Menyimpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required|numeric',
            'rayon' => 'required',
            'rombel' => 'required',
        ], [
            'nama.required' => 'Nama siswa harus diisi!',
            'nis.required' => 'NIS harus diisi!',
            'rayon.required' => 'Rayon harus diisi!',
            'rombel.required' => 'Rombel harus diisi!'
        ]);

        dataSiswa::create([
            'nama' => $request->input('nama'),
            'nis' => $request->input('nis'),
            'rayon' => $request->input('rayon'),
            'rombel' => $request->input('rombel'),
        ]); // Menyimpan data siswa ke database

        return redirect()->route('index_data.index')->with('success', 'Data siswa berhasil disimpan!'); // Mengarahkan kembali ke daftar siswa
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        $siswa = dataSiswa::findOrFail($id); // Mencari siswa berdasarkan ID
        return view('siswa.edit', compact('siswa')); // Mengirim data siswa ke view untuk diedit
    }

    // Memperbarui data siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required|numeric',
            'rayon' => 'required',
            'rombel' => 'required'
        ]);

        $siswa = dataSiswa::findOrFail($id); // Mencari siswa berdasarkan ID
        $siswa->update($request->all()); // Memperbarui data siswa

        return redirect()->route('index_data.index')->with('success', 'Data siswa berhasil diperbarui!'); // Mengarahkan kembali ke daftar siswa
    }

    // Menghapus siswa
    public function destroy($id)
    {
        $siswa = dataSiswa::findOrFail($id); // Mencari siswa berdasarkan ID
        $siswa->delete(); // Menghapus siswa dari database

        return redirect()->route('index_data.index')->with('success', 'Data siswa berhasil dihapus!'); // Mengarahkan kembali ke daftar siswa
    }
}
