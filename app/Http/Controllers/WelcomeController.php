<?php

namespace App\Http\Controllers;

use App\Bandara;
use App\JadwalPenerbangan;
use App\Pesawat;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $jadwal = new JadwalPenerbangan();
        $bandara = new Bandara();
        $pesawat = new Pesawat();

        $data = array();
        $data['jadwal'] = $jadwal->getJadwalPenerbangan();
        $data['bandara'] = $bandara->getDataBandara();
        $data['pesawat'] = $pesawat->getDataPesawat();

        return view('welcome/index', $data);
    }
}
