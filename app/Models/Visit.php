<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Visit extends Model
{
    protected $guarded = [
        // 'no_visit',
        // 'id_pasien',
        // 'id_poli',
        // 'id_pegawai',
        // 'no_antrian',
        // 'status',
        // 'vitals',
        // 'diagnosis',
        // 'tanggal_kunjungan'
        'id'
    ];
    protected $table = 'visits';
    protected $primaryKey = 'id';


    // Cast visit_date ke Carbon
    protected $casts = [
        'vitals' => 'array',
        'visit_date' => 'date'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
    
    public function pegawai(){ return $this->belongsTo(Pegawai::class,'id_pegawai'); }
}
