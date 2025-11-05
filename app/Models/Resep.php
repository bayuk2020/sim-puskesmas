<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    protected $fillable = ['id_kunjungan', 'id_pegawai', 'tanggal_resep', 'total_harga'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function resepDetail()
    {
        return $this->hasMany(ResepDetail::class, 'id_resep');
    }

}
