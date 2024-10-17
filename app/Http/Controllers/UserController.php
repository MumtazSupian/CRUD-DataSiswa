<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
     // Menampilkan daftar akun pengguna
     public function index()
     {
         $users = User::paginate(10); // Mengambil data pengguna dengan paginasi
         return view('kelola.akun', compact('users')); // Mengirim data pengguna ke view
     }
 
     // Menampilkan form pembuatan akun pengguna
     public function create()
     {
         return view('kelola.create_akun'); // Mengirim view untuk form pembuatan akun pengguna
     }
 
     // Menyimpan akun pengguna baru
     public function store(Request $request)
     {
         $request->validate([
             'nama' => 'required|max:100',
             'email' => 'required|email|unique:users,email',
             'password' => 'required',
             'role' => 'required'
         ], [
             'nama.required' => 'Nama pengguna harus diisi!',
             'email.required' => 'Email harus diisi!',
             'email.unique' => 'Email sudah digunakan!',
             'password.required' => 'Password harus diisi!',
             'role.required' => 'Role harus diisi!'
         ]);
 
         User::create([
             'nama' => $request->input('nama'),
             'email' => $request->input('email'),
             'password' => bcrypt($request->input('password')), // Enkripsi password
             'role' => $request->input('role')
         ]); // Menyimpan data akun pengguna ke database
 
         return redirect()->route('kelola_akun.index')->with('success', 'Akun pengguna berhasil dibuat!');
     }
 
     // Menampilkan form edit akun pengguna
     public function edit($id)
     {
         $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
         return view('kelola.edit_akun', compact('user')); // Mengirim data pengguna ke view untuk diedit
     }
 
     // Memperbarui data akun pengguna
     public function update(Request $request, $id)
     {
         $request->validate([
             'nama' => 'required|max:100',
             'email' => 'required|email|unique:users,email,' . $id,
             'password' => 'nullable',
             'role' => 'required'
         ]);
 
         $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
         $user->nama = $request->input('nama');
         $user->email = $request->input('email');
         $user->role = $request->input('role');
 
         if ($request->filled('password')) {
             $user->password = bcrypt($request->input('password')); // Enkripsi password jika diisi
         }
 
         $user->save(); // Menyimpan perubahan data pengguna
 
         return redirect()->route('kelola_akun.index')->with('success', 'Akun pengguna berhasil diperbarui!');
     }
 
     // Menghapus akun pengguna
     public function destroy($id)
     {
         $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
         $user->delete(); // Menghapus pengguna dari database
 
         return redirect()->route('kelola_akun.index')->with('success', 'Akun pengguna berhasil dihapus!');
     }
 }

