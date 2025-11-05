<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepDetail extends Model
{
    protected $table = 'resep_detail';
    protected $primaryKey = 'id_resep_detail';
    protected $fillable = ['id_resep', 'id_obat', 'jumlah', 'aturan_pakai', 'subtotal'];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
