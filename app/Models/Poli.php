<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $primaryKey = 'id_poli';
    protected $fillable = ['nama_poli','keterangan'];
    public function kunjungan(){ return $this->hasMany(Kunjungan::class,'id_poli'); }
}
