<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_nilai';
    protected $fillable = ['karyawan','kategori_id','user_id', 'skor', 'tanggal_penilaian'];

    public function qaryawan(){
        return $this->belongsTo(User::class, 'karyawan');
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function tim_penilai(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
