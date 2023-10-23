<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hewan;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\Paket;
use App\Models\Dokter;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
