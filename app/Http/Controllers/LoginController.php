<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use TiketPenerbangan;

class LoginController extends Controller
{
    public function index()
    {
        if (isLogin()) {
            return redirect('dashboard');
        }

        return view('login.index');
    }

    public function process_login(Request $request)
    {
        if (isLogin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Anda telah berstatus login');
        }

        $username = $request->post('username');
        $password = $request->post('password');

        $msuser = User::where('username', $username)->first();

        if ($msuser == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Username atau password yang anda masukkan salah');
        } else {
            if ($msuser->password !== $password) {
                return JSONResponseDefault(TiketPenerbangan::FAILED, 'Username atau password yang anda masukkan salah');
            }

            Session::put('is_login', true);
            Session::put('username', $username);
            Session::put('role', $msuser->role);

            return JSONResponseDefault(TiketPenerbangan::OK, 'Login success');
        }
    }
}
