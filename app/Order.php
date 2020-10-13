<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tborder';
    protected $primaryKey = "id_order";
    public $timestamps = false;
}
