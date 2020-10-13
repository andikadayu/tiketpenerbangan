<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use Illuminate\Http\Request;
use TiketPenerbangan;

class JadwalController extends Controller
{
    public function process_add(Request $request)
    {
        $jadwal_model = new JadwalPenerbangan();

        $pesawat = $request->post('pesawat');
        $asal = $request->post('asal');
        $tujuan = $request->post('tujuan');
        $jadwal = $request->post('jadwal');

        $insert = array();
        $insert['id_pesawat'] = $pesawat;
        $insert['id_bandara_asal'] = $asal;
        $insert['id_bandara_tujuan'] = $tujuan;
        $insert['tgl_jadwal'] = date('Y-m-d', strtotime($jadwal));

        $process = $jadwal_model->insert($insert);

        if ($process) {
            echo json_encode(array(
                'RESULT' => 'OK',
                'MESSAGE' => 'Success to insert data to table'
            ));
        } else {
            echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Failed to insert data to table'
            ));
        }
    }

    function getting(Request $request)
    {
        $jadwal_model = new JadwalPenerbangan();

        return $jadwal_model->getting($request->get('id'));
    }

    function process_update(Request $request)
    {
        $jadwal_model = new JadwalPenerbangan();

        $pesawat = $request->post('pesawat');
        $asal = $request->post('asal');
        $tujuan = $request->post('tujuan');
        $jadwal = $request->post('jadwal');
        $id = $request->post('id_jadwal');

        $update = array();
        $update['id_pesawat'] = $pesawat;
        $update['id_bandara_asal'] = $asal;
        $update['id_bandara_tujuan'] = $tujuan;
        $update['tgl_jadwal'] = date('Y-m-d', strtotime($jadwal));


        $process = $jadwal_model->upd($id, $update);

        if ($process) {
            echo json_encode(array(
                'RESULT' => 'OK',
                'MESSAGE' => 'Success to update data to table'
            ));
        } else {
            echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Failed to update data to table'
            ));
        }
    }

    function delete(Request $request)
    {
        $jadwal_model = new JadwalPenerbangan();
        $process = $jadwal_model->del($request->get('id'));

        if ($process < 0) {
            return 'error';
        } else {
            return 'success';
        }
    }

    public function data_jadwal(Request $request)
    {
        $bandara_asal = $request->post('bandara_asal');
        $bandara_tujuan = $request->post('bandara_tujuan');

        if ($bandara_asal == null || $bandara_tujuan == null) {
            return JSONResponseDefault(TiketPenerbangan::ERROR, TiketPenerbangan::ERROR);
        }

        $jadwal = JadwalPenerbangan::select(array('jadwal_penerbangan.*', 'pesawat.nama_pesawat'))
            ->join('pesawat', 'pesawat.id_pesawat', '=', 'jadwal_penerbangan.id_pesawat')
            ->where('id_bandara_asal', $bandara_asal)
            ->where('id_bandara_tujuan', $bandara_tujuan)
            ->get();

        $data = array();
        $data['jadwal'] = $jadwal;

        return JSONResponse(array(
            'RESULT' => TiketPenerbangan::OK,
            'CONTENT' => view('user.content', $data)->render()
        ));
    }
}
