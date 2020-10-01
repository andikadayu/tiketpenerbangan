<?php

namespace App\Http\Controllers;

use App\Bandara;
use App\JadwalPenerbangan;
use App\Pesawat;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $jadwal = new JadwalPenerbangan();
        $bandara = new Bandara();
        $pesawat = new Pesawat();

        $data = array();
        $data['jadwal'] = $jadwal->getJadwalPenerbangan($search);
        $data['bandara'] = $bandara->getDataBandara();
        $data['pesawat'] = $pesawat->getDataPesawat();

        $data['request'] = $request;

        return view('welcome/index', $data);
    }
}
