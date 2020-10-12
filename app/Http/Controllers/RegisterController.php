<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use TiketPenerbangan;

class RegisterController extends Controller
{
    public function index()
    {
        if (isLogin()) {
            return redirect('dashboard');
        }

        return view('register.index');
    }

    public function process_register(Request $request)
    {
        if (isLogin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Anda telah berstatus login');
        }

        $nama = $request->post('nama');
        $username = $request->post('username');
        $password = $request->post('password');
        $confirmpassword = $request->post('confirmpassword');

        $checkUsername = User::where('username', $username)->first();

        if ($checkUsername != null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Username yang anda masukkan sudah terdaftar');
        }

        if ($password !== $confirmpassword) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Password yang anda masukkan tidak sesuai');
        }

        $msuser = new User();
        $msuser->nama = $nama;
        $msuser->username = $username;
        $msuser->password = $password;
        $msuser->role = 'user';

        $insert = $msuser->save();

        if ($insert) {
            return JSONResponseDefault(TiketPenerbangan::OK, 'Pendaftaran berhasil');
        } else {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Pendaftaran gagal');
        }
    }
}
