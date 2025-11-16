<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Visit extends Model
{
    protected $fillable = [
        'no_visit','patient_id','poli_id','staff_id','no_antrian',
        'status','vitals','diagnosis','visit_date'
    ];

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
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }
    
    public function pegawai(){ return $this->belongsTo(Pegawai::class,'id_pegawai'); }
}
