<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalEkskul extends Model
{
    protected $table = 'jadwal_ekskul';
    protected $fillable = ['user_id', 'hari', 'waktu_mulai', 'waktu_selesai'];

    public function profile()
    {
        return $this->belongsTo(AdminProfile::class, 'user_id', 'user_id');
    }
}
