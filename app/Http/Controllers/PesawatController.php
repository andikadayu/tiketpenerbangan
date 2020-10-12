<?php

namespace App\Http\Controllers;

use App\Pesawat;
use Illuminate\Http\Request;
use TiketPenerbangan;

class PesawatController extends Controller
{
    public function index()
    {
        $data = array();
        $data['pesawat'] = Pesawat::all();

        return view('pesawat.index', $data);
    }

    public function modal_add()
    {
        if (!isAdmin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Access denied');
        }

        $data = array();
        $data['type'] = 'ADD';

        return JSONResponse(array(
            'RESULT' => TiketPenerbangan::OK,
            'CONTENT' => view('pesawat.modal', $data)->render()
        ));
    }

    public function process_add(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Access denied');
        }

        $pesawat_inp = $request->post('pesawat');

        if ($pesawat_inp == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Nama pesawat tidak boleh kosong');
        }

        $pesawat = new Pesawat();
        $pesawat->id_pesawat = generateIDPesawat(strtoupper($pesawat_inp[0]));
        $pesawat->nama_pesawat = $pesawat_inp;

        $insert = $pesawat->save();

        if ($insert) {
            return JSONResponseDefault(TiketPenerbangan::OK, 'Data berhasil ditambahkan');
        } else {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Gagal menambahkan data');
        }
    }

    public function process_delete(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Access denied');
        }

        $id_pesawat = $request->post('id_pesawat');

        $pesawat = Pesawat::find($id_pesawat);

        if ($pesawat == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Data tidak ditemukan');
        }

        $delete = $pesawat->delete();

        if ($delete) {
            return JSONResponseDefault(TiketPenerbangan::OK, 'Data berhasil dihapus');
        } else {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Gagal menghapus data');
        }
    }

    public function modal_edit(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Access denied');
        }

        $id_pesawat = $request->get('id_pesawat');

        $pesawat = Pesawat::find($id_pesawat);

        if ($pesawat == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Data tidak ditemukan');
        }

        $data = array();
        $data['type'] = 'EDIT';
        $data['pesawat'] = $pesawat;

        return JSONResponse(array(
            'RESULT' => TiketPenerbangan::OK,
            'CONTENT' => view('pesawat.modal', $data)->render()
        ));
    }

    public function process_edit(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Access denied');
        }

        $id_pesawat = $request->post('id_pesawat');
        $pesawat = $request->post('pesawat');

        $checkPesawat = Pesawat::find($id_pesawat);

        if ($pesawat == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Nama pesawat tidak boleh kosong');
        } elseif ($checkPesawat == null) {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Data tidak ditemukan');
        }

        $checkPesawat->nama_pesawat = $pesawat;

        $update = $checkPesawat->save();

        if ($update) {
            return JSONResponseDefault(TiketPenerbangan::OK, 'Data berhasil diubah');
        } else {
            return JSONResponseDefault(TiketPenerbangan::FAILED, 'Gagal mengubah data');
        }
    }
}
