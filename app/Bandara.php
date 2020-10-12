<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bandara extends Model
{

	protected $table = 'bandara';
	protected $primaryKey = 'id_bandara';
	protected $keyType = 'string';
    public $timestamps = null;

    public function getDataBandara()
    {
        return DB::table('bandara')->get();
    }
}
