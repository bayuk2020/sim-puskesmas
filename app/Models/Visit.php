<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Visit extends Model
{
    protected $fillable = ['id_pasien', 'id_poli', 'visit_date', 'keluhan', 'diagnosa', 'tindakan'];

    // Cast visit_date ke Carbon
    protected $casts = [
        'visit_date' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }
}
