<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    protected $table = 'jenis_hewan'; // Jika nama tabel berbeda

    protected $fillable = ['nama_jenis', 'deskripsi'];

    public function hewan()
    {
    	return $this->hasOne(Hewan::class);
    }
}
