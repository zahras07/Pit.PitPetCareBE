<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function user()
    {
        return $this->belongsTo(User::Class,'user_id');
    }
    public function hewan()
    {
        return $this->hasMany(Hewan::Class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::Class);
    }
}


