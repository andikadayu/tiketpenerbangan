<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class JadwalPenerbangan extends Model
{

    public function getJadwalPenerbangan()
    {
        $pdo = DB::getPdo();

        $sql = "SELECT id_jadwal , b.nama_pesawat, c.nama_bandara AS bandara_asal, d.nama_bandara AS bandara_tujuan, a.tgl_jadwal FROM jadwal_penerbangan a JOIN pesawat b ON b.id_pesawat = a.id_pesawat JOIN bandara c ON c.id_bandara = a.id_bandara_asal JOIN bandara d ON d.id_bandara = a.id_bandara_tujuan";

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
            ->where('id_jadwal',$id)
            ->get();
    }

    public function upd($id, $upd = array())
    {
        return DB::table('jadwal_penerbangan')->where('id_jadwal',$id)->update($upd);
    }

}
