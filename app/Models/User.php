<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['no_telp', 'nama_lengkap', 'jabatan', 'email', 'nip',  'password'];
    protected $hidden = ['password'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'user_id');
    }

    public function pelaporan(){
        return $this->hasMany(Pelaporan::class, 'user_id');
    }

    public function qaryawan(){
        return $this->hasMany(Penilaian::class, 'karyawan');
    }

    public function tim_penilai(){
        return $this->hasMany(Penilaian::class, 'user_id');
    }
}
