<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pawongan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'latlang',
        'telp',
        'photo',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function lanjas()
    {
        return $this->hasMany(Lanja::class);
    }

/*     public function sawahs()
    {
        return $this->belongsToMany(Sawah::class,'pawongan_sawah')->withTimestamps();
    } */

}
