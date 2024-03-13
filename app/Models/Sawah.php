<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sawah extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nosawah',
        'namasawah',
        'luas',
        'lokasi',
        'latlang',
        'b_barat',
        'b_utara',
        'b_timur',
        'b_selatan',
        'namapenjual',
        'hargabeli',
        'namapembeli',
        'tglbeli',
        'hargajual',
        'tgljual',
        'nop',
        'nilaipajak',
        'img',
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

/*     public function pawongans()
    {
        return $this->belongsToMany(Pawongan::class,'pawongan_sawah')->withTimestamps();
    } */
}
