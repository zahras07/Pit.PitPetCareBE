<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;
    protected $guarded=[];
   
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class, 'hewan_id');
    }
    public function jenishewan()
    {
    	return $this->belongsTo(JenisHewan::class,'jenis_hewan');
    }
    
}
