<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakanPasien extends Model
{
     protected $table = 'tindakan_pasien';
    protected $primaryKey = 'id_tindakan_pasien';
    protected $fillable = ['id_kunjungan', 'id_tindakan', 'jumlah', 'subtotal'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan');
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class, 'id_tindakan');
    }
}
