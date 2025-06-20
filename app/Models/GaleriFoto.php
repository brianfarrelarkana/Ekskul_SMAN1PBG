<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';
    protected $fillable = ['user_id', 'path'];

    public function profile()
    {
        return $this->belongsTo(AdminProfile::class, 'user_id', 'user_id');
    }
}
