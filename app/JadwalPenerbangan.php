<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class JadwalPenerbangan extends Model
{
    protected $table = 'jadwal_penerbangan';

    public function getJadwalPenerbangan($like = null)
    {
        $pdo = DB::getPdo();

        $query_like = "";
        if ($like !== null) {
            $query_like = "WHERE b.nama_pesawat LIKE '%$like%' OR c.nama_bandara LIKE '%$like%' OR d.nama_bandara LIKE '%$like%'";
        }

        $sql = "SELECT a.id_jadwal, a.jam_berangkat, a.jam_sampai, b.nama_pesawat, c.nama_bandara AS bandara_asal, d.nama_bandara AS bandara_tujuan, a.tgl_jadwal FROM jadwal_penerbangan a JOIN pesawat b ON b.id_pesawat = a.id_pesawat JOIN bandara c ON c.id_bandara = a.id_bandara_asal JOIN bandara d ON d.id_bandara = a.id_bandara_tujuan $query_like";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($data = array())
    {
        return DB::table('jadwal_penerbangan')->insert($data);
    }

    public function getting($id)
    {
        return DB::table('jadwal_penerbangan')
            ->where('id_jadwal', $id)
            ->get();
    }

    public function upd($id, $upd = array())
    {
        return DB::table('jadwal_penerbangan')->where('id_jadwal', $id)->update($upd);
    }

    function del($id)
    {
        return DB::table('jadwal_penerbangan')->where('id_jadwal', $id)->delete();
    }

    public function pesawat()
    {
        return $this->belongsTo('App\Pesawat');
    }
}
