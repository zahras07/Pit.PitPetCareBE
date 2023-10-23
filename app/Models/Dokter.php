<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Dokter extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getPhotoUrlAttribute()
    {
        return asset(Storage::url('img_dokter/' . $this->foto));
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'dokter_id');
    }

    public function jadwaldokter()
    {
    	return $this->hasOne(JadwalDokter::class);
    }
}
