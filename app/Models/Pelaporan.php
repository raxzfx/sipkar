<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    protected $table = 'pelaporan';
    protected $primaryKey = 'id_pelaporan';
    protected $fillable = ['user_id', 'keterangan', 'tanggal_pelaporan', 'status', 'aktivitas','file','komentar', 'nilai_akhir','nilai_1','nilai_2','nilai_3', 'kode_unik'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function historis()
{
    return $this->hasMany(Histori::class, 'pelaporan_id');
}
}
