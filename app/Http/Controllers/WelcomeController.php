<?php

namespace App\Http\Controllers;

use App\JadwalPenerbangan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $jadwal = new JadwalPenerbangan();

        $data = array();
        $data['jadwal'] = $jadwal->getJadwalPenerbangan();

        return view('welcome/index', $data);
    }
}
