<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bandara extends Model
{
    public function getDataBandara()
    {
        return DB::table('bandara')->get();
    }
}
