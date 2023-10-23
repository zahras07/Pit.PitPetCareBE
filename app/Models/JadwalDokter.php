<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['id_dokter', 'day', 'jam_mulai', 'jam_selesai', 'keterangan', 'status'];
    use HasFactory;
    public function dokter()
    {
    	return $this->belongsTo(Dokter::class);
    }
}


