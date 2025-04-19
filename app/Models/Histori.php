<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    protected $table = 'histori';
    protected $fillable = ['pelaporan_id', 'status', 'nilai_akhir', 'komentar','user_id'];

    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class, 'pelaporan_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
