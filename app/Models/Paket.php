<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::Class, 'paket_id');
    }

    public function layanan()
    {
    	return $this->belongsTo(Layanan::class);
    }

}
