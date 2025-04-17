<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    protected $fillable = ['id_divisi', 'nama_divisi'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
}
