<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    protected $table = 'pelaporan';
    protected $primaryKey = 'id_pelaporan';
    protected $fillable = ['user_id', 'keterangan', 'tanggal_pelaporan', 'status', 'aktivitas'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
