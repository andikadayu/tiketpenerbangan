<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use Illuminate\Http\Request;

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
}
