<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::Class, 'layanan_id');
    }
    public function paket()
    {
    	return $this->hasOne(Paket::class);
    }
}
