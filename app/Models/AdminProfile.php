<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_ekskul',
        'deskripsi',
        'link_youtube',
        'banner',
        'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalEkskul::class, 'user_id', 'user_id');
    }

    public function galeri()
    {
        return $this->hasMany(GaleriFoto::class, 'user_id', 'user_id');
    }
}
