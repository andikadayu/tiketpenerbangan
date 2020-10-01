<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesawat extends Model
{
    public function getDataPesawat()
    {
        return DB::table('pesawat')->get();
    }
}
