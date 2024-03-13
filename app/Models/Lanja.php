<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lanja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tahun',
        'nilailanja',
        'sawah_id',
        'pawongan_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function pawongans()
    {
        return $this->belongsTo(Pawongan::class);
    }

    public function sawahs()
    {
        return $this->belongsTo(Sawah::class);
    }

}
