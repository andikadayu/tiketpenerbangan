<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesawat extends Model
{
    protected $table = 'pesawat';
    protected $primaryKey = 'id_pesawat';
    protected $keyType = 'string';
    public $timestamps = null;

    public function getDataPesawat()
    {
        return DB::table('pesawat')->get();
    }
}
