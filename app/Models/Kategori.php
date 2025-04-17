<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_penilaian';
    protected $primaryKey = 'id_kategori_penilaian';
    protected $fillable = ['nama_kategori','nilai'];

    public function penilaian(){
        return $this->hasMany(Penilaian::class, 'kategori_id');
    }
}
