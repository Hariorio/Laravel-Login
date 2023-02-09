<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginlaravel extends Controller
{
    public function login(Request $request)

    {
        //validasi input dari user
        $validatedData = $request->validate([
            'username' => 'username',
            'password' => 'required'
        ]);
    
        //cari data user berdasarkan email yang dimasukkan
        $user = User::where('username', $request->username)->first();
    
        //cek apakah user ada dan password yang dimasukkan benar
        if ($user && Hash::check($request->password, $user->password)) {
            //simpan user ke session
            $request->session()->put('user', $user);
    
            //redirect ke halaman yang ditentukan setelah login berhasil
            return redirect('/dashboard');
        }
    
        //jika login gagal, kembalikan user ke halaman login dan tampilkan pesan error
        return redirect('/login')->with('error', 'Email atau password yang Anda masukkan salah.');
    }

}
