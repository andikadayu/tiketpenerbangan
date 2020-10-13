<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use TiketPenerbangan;

class OrderController extends Controller
{
    public function modal_order(Request $request)
    {
        $id_jadwal = $request->post('id_jadwal');

        $jadwal = JadwalPenerbangan::find($id_jadwal);

        if ($jadwal == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Jadwal tidak ditemukan');
        }

        $data = array();
        $data['jadwal'] = $jadwal;

        return JSONResponse(array(
            'RESULT' => TiketPenerbangan::OK,
            'CONTENT' => view('user.ordermodal', $data)->render()
        ));
    }

    public function process_order(Request $request)
    {
        $id_jadwal = $request->post('id_jadwal');
        $username = $request->post('username');
        $password = $request->post('password');
        $jumlah = $request->post('jumlah');

        $jadwal_penerbangan = JadwalPenerbangan::find($id_jadwal);

        if ($jadwal_penerbangan == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Jadwal tidak ditemukan');
        }

        if ($jadwal_penerbangan->stok < $jumlah) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Stok jadwal tidak mencukupi');
        } else if ($jumlah > 3) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Maksimal jumlah pembelian adalah 3');
        }

        $user = User::where('username', $username)->where('password', $password)->first();

        if ($user == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Username atau password yang anda masukkan salah');
        }

        $order = new Order();
        $order->id_user = $user->id;
        $order->id_jadwal = $id_jadwal;
        $order->tgl_pemesanan = Date('Y-m-d H:i:s');
        $order->jumlah_pesanan = $jumlah;
        $order->tarif = $jadwal_penerbangan->tarif;

        $jadwal_penerbangan->stok = $jadwal_penerbangan->stok - $jumlah;
        $jadwal_penerbangan->save();

        $beli = $order->save();

        if ($beli) {
            Session::put('is_login', true);
            Session::put('username', $username);
            Session::put('role', $user->role);

            return JSONResponseDefault(TiketPenerbangan::OK, 'Pembelian berhasil');
        } else {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Pembelian gagal');
        }
    }
}
