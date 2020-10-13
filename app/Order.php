<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Order extends Model
{
    protected $table = 'tborder';
    protected $primaryKey = "id_order";
    public $timestamps = false;

    function getOrder($search)
    {
    	if (isAdmin()) {
    		$data = DB::table('tborder')
    			->select('tborder.tgl_pemesanan','tborder.id_order','tborder.id_user','user.nama as nama','pes.nama_pesawat','asal.nama_bandara as bandara_asal','tuj.nama_bandara as bandara_tujuan','jadwal.jam_berangkat as berangkat','jadwal.jam_sampai as sampai','jadwal.tgl_jadwal','tborder.tarif as tarif','tborder.jumlah_pesanan')
    			->join('msuser as user','tborder.id_user','=','user.id')
    			->join('jadwal_penerbangan as jadwal','tborder.id_jadwal','=','jadwal_penerbangan.id_jadwal')
    			->join('bandara as asal','jadwal_penerbangan.id_bandara_asal','=','bandara.id_bandara')
    			->join('bandara as tuj','jadwal_penerbangan.id_bandara_tujuan','=','bandara.id_bandara')
    			->join('pesawat as pes','jadwal_penerbangan.id_pesawat','=','pesawat.id_pesawat')
    			->where('nama_pesawat','like','%'.$search)
    			->paginate(5);
    	} else {
    		$data = DB::table('tborder')
    			->select('tborder.tgl_pemesanan','tborder.id_order','tborder.id_user','user.nama as nama','pes.nama_pesawat','asal.nama_bandara as bandara_asal','tuj.nama_bandara as bandara_tujuan','jadwal.jam_berangkat as berangkat','jadwal.jam_sampai as sampai','jadwal.tgl_jadwal','tborder.tarif as tarif','tborder.jumlah_pesanan')
    			->join('msuser as user','tborder.id_user','=','user.id')
    			->join('jadwal_penerbangan as jadwal','tborder.id_jadwal','=','jadwal.id_jadwal')
    			->join('bandara as asal','jadwal.id_bandara_asal','=','asal.id_bandara')
    			->join('bandara as tuj','jadwal.id_bandara_tujuan','=','tuj.id_bandara')
    			->join('pesawat as pes','jadwal.id_pesawat','=','pes.id_pesawat')
    			->where('username','=',Session::get('username'))
    			->where('nama_pesawat','like','%'.$search)
    			->paginate(5); 
    	}
    	return $data;
    }
}
